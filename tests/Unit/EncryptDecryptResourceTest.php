<?php

use AOWD\envLoader\ResourceLoader;

test('Encrypt/Decrypt Resource', function () {
    $resource = ResourceLoader::loadResource(TEST_RESOURCE);
    $public_key = file_get_contents(TEST_PUBLIC_KEY);
    $private_key = file_get_contents(TEST_PRIVATE_KEY);
    $crypted = ResourceLoader::encryptEnvironmentVariables($resource, $public_key);
    $result = ResourceLoader::decryptEnvironmentVariables($crypted, $private_key);

    // Save crypted resource for later
    file_put_contents(TEST_CRYPTED_RESOURCE, json_encode(ResourceLoader::encryptEnvironmentVariables($resource, $public_key), JSON_PRETTY_PRINT));

    expect($result)->toBe(TEST_ARRAY);
});

test('Decrypt External Resource', function () {
    $crypted = json_decode(file_get_contents(TEST_CRYPTED_RESOURCE), true);
    $private_key = file_get_contents(TEST_PRIVATE_KEY);
    $result = ResourceLoader::decryptEnvironmentVariables($crypted, $private_key);

    expect($result)->toBe(TEST_ARRAY);
});
