<?php

// Require dotenv loader
require_once dirname(__DIR__, 1) . '/src/dotenv-loader.php';

// Load .env file
AOWD\envLoader\load(__DIR__ . '/.env');

print_r($_ENV);
