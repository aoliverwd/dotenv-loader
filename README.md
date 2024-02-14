# Environment Variables Loader

Load configuration variables into your PHP application's global namespace from an `.env` file for flexible management across different environments.
## Installation

```bash
composer require alexoliverwd/dotenv-loader
```

## Basic Usage

```php
\AOWD\envLoader\ResourceLoader::applyEnvironmentVariables(__DIR__ . '/.env');
```

## Public Class Methods

### loadResource

```php
loadResource(
	string $resource_location
): array
```

The `loadResource` method retrieves key-value pairs from a configuration file, like `/home/.env`, providing a structured and flexible way to manage application settings across various environments.
### applyEnvironmentVariables

```php
applyEnvironmentVariables(
	string $resource_location
): void
```

The `applyEnvironmentVariables` method imports key-value pairs from a configuration file, like `/home/.env`, directly into PHP's global namespace, making them accessible throughout your application using the built-in `$_ENV`[ superglobal variable](https://www.php.net/manual/en/reserved.variables.environment).
### encryptEnvironmentVariables

```php
encryptEnvironmentVariables(
	array $environment_variables,
	string $public_key_content
): array
```

The encryptEnvironmentVariables method encrypts the values of the key, value pair array using a provided public key.
### decryptEnvironmentVariables

```php
decryptEnvironmentVariables(
	array $environment_variables,
	string $private_key_content
): array
```

The decryptEnvironmentVariables method decrypts the values of the key, value pair array using a provided private key.