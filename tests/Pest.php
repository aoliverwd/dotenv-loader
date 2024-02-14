<?php

require_once dirname(__DIR__) . '/src/dotenv-loader.php';

use AOWD\envLoader\ResourceLoader;

define('TEST_RESOURCE', __DIR__ . '/test-assets/env-eample.txt');
define('TEST_PUBLIC_KEY', __DIR__ . '/test-assets/public.pem');
define('TEST_PRIVATE_KEY', __DIR__ . '/test-assets/private.pem');
define('TEST_CRYPTED_RESOURCE', __DIR__ . '/test-assets/crypted.json');

define('TEST_ARRAY', [
    'APP_NAME' => 'my_app',
    'ENVIRONMENT' => 'development',
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'username',
    'DB_PASSWORD' => 'password',
    'DB_DATABASE' => 'database_name'
]);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
