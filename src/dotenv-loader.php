<?php

namespace AOWD\envLoader;

// Require resource loader class
require_once __DIR__ . '/resource-loader.php';

/**
 * Load environment variables
 * @param  string $env_file
 * @return void
 */
function load(string $env_file): void
{
    ResourceLoader::applyEnvironmentVariables($env_file);
}
