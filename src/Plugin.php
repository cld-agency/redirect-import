<?php

namespace CLD\RedirectImport;

use craft\base\Plugin;

class RedirectImport extends Plugin
{
    /**
     * @var \League\Container\ContainerInterface
     */
    private $container;

    /**
     * Initialise the plugin.
     */
    public function init()
    {
        parent::init();

        // Build the service container.
        $this->container = new League\Container\Container;

        // Work with spreadsheets.
        $this->container->add('SpreadsheetReader', CLD\RedirectImport\Spreadsheet\PhpSpreadsheet::class);

        // Work with Craft.
        $this->container->add('Craft', CLD\RedirectImport\Craft\Database::class)
            ->addArgument(new CLD\RedirectImport\Database\PDO)
            ->addArgument(new CLD\RedirectImport\UUID\Ramsey);
    }
}
