<?php

$container = new League\Container\Container;

// Interact with the CLI.
$container->add('CLI', CLD\RedirectImport\CLI\CLImate::class);

// Work with spreadsheets.
$container->add('SpreadsheetReader', CLD\RedirectImport\Spreadsheet\PhpSpreadsheet::class);

// Work with Craft.
$container->add('Craft', CLD\RedirectImport\Craft\Database::class)
    ->addArgument(new CLD\RedirectImport\Database\PDO)
    ->addArgument(new CLD\RedirectImport\UUID\Ramsey);

return $container;
