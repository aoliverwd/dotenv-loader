<?php

namespace AOWD\envLoader;

/**
 * Load environment variables
 * @param  string $env_file
 * @return void
 */
function load(string $env_file): void
{
    if (file_exists($env_file)) {
        //open env file
        $handle = fopen($env_file, "r");

        if (is_resource($handle)) {
            //read resource line by line
            while (($buffer = fgets($handle, 4096)) !== false) {
                // Check line is not empty or is not a comment
                if (strlen(trim($buffer)) > 0 || substr(trim($buffer), 0, 1) !== '#') {
                    // Match key and variable
                    if (preg_match('/^(.*?)=(.*)/', trim($buffer), $matches)) {
                        if (count($matches) === 3) {
                            //add to environment
                            try {
                                $_ENV[$matches[1]] = getenv($matches[1]) ? getenv($matches[1]) : $matches[2];
                            } catch (\Exception $e) {
                                error_log("$e", 0);
                            }
                        }
                    }
                }
            }
        }
    }
}
