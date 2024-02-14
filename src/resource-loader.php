<?php

namespace AOWD\envLoader;

/**
 * Resource loader class
 */
final class ResourceLoader
{
    /**
     * Load resource into a manageable array
     * @param  string $resource_location
     * @return array<mixed>
     */
    public static function loadResource(string $resource_location): array
    {
        if (file_exists($resource_location)) {
            //open env file
            $handle = fopen($resource_location, "r");

            if (is_resource($handle)) {
                // Set return array
                $return_array = [];

                //read resource line by line
                while (($buffer = fgets($handle, 4096)) !== false) {
                    // Check line is not empty or is not a comment
                    if (!empty($buffer) || substr(trim($buffer), 0, 1) !== '#') {
                        // Match key and variable
                        if (preg_match('/^(.*?)=(.*)/', trim($buffer), $matches)) {
                            if (count($matches) === 3) {
                                $return_array[$matches[1]] = $matches[2];
                            }
                        }
                    }
                }

                // Close resource
                fclose($handle);

                // Return array
                return $return_array;
            }
        }

        return [];
    }

    /**
     * Apply Environment Variables
     * @param  string $resource_location
     * @return void
     */
    public static function applyEnvironmentVariables(string $resource_location): void
    {
        foreach (self::loadResource($resource_location) as $key => $value) {
            //add environment variables
            try {
                $_ENV[$key] = getenv($key) ? getenv($key) : $value;
            } catch (\Exception $e) {
                error_log("$e", 0);
            }
        }
    }

    /**
     * Encrypt Environment Variables
     * @param  array<mixed>  $environment_variables
     * @param  string $public_key_content
     * @return array<mixed>
     */
    public static function encryptEnvironmentVariables(array $environment_variables, string $public_key_content): array
    {
        return array_map(function ($variable_content) use ($public_key_content) {
            openssl_public_encrypt($variable_content, $crypted, $public_key_content, OPENSSL_PKCS1_OAEP_PADDING);
            return base64_encode($crypted);
        }, $environment_variables);
    }

    /**
     * Decrypt EnvironmentVariables
     * @param  array<mixed>  $environment_variables
     * @param  string $private_key_content
     * @return array<mixed>
     */
    public static function decryptEnvironmentVariables(array $environment_variables, string $private_key_content): array
    {
        return array_map(function ($variable_content) use ($private_key_content) {
            openssl_private_decrypt(base64_decode($variable_content), $decrypted, $private_key_content, OPENSSL_PKCS1_OAEP_PADDING);
            return $decrypted;
        }, $environment_variables);
    }
}
