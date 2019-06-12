<?php

declare(strict_types=1);

// Autoload dependencies.
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new Exception('Run `composer install`.');
}

require_once __DIR__ . '/vendor/autoload.php';

// Load the .env file.
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Build the service container.
$container = require_once(__DIR__ . '/bootstrap/container.php');

// Start the importer program.
$import = new CLD\RedirectImport\Import($container);
$import->init();
