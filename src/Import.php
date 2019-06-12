<?php

namespace CLD\RedirectImport;

use Psr\Container\ContainerInterface;

/**
 * This class acts as the entry point. `init()` is called by `../index.php`,
 * which does autoloading and bootstrapping.
 */
class Import
{
    /**
     * @var \League\Container\ContainerInterface
     */
    private $container;

    /**
     * Set-up.
     *
     * @param \League\Container\ContainerInterface $container The service container.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Let's get going.
     *
     * @return void
     * @throws \ClinimedImport\Exceptions\NotFound
     */
    public function init(): void
    {
        $file = getFileLocation($this->container->get('CLI'));
        if (!file_exists($file)) {
            $this->container->get('CLI')->write('File not found.', 'error');
            return;
        }

        $reader = getReader($file, $this->container->get('SpreadsheetReader'));

        // We have a reader. Let's read.
        $rows = prepareFile($reader);
        array_shift($rows);

        $inserted = insert($this->container->get('Craft'), $rows);
        $this->container->get('CLI')->write("Inserted $inserted re-directs.");
    }
}
