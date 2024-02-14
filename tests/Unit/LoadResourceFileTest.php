<?php

use AOWD\envLoader\ResourceLoader;

test('Load Resource into Array', function () {
    $result = ResourceLoader::loadResource(TEST_RESOURCE);
    expect($result)->toBe(TEST_ARRAY);
});
