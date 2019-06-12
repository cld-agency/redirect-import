<?php

namespace CLD\RedirectImport\CLI;

use CLD\RedirectImport\Interfaces\CLI;
use League\CLImate\CLImate as Provider;

/**
 * Implements the CLI interface using PHP Leagues CLImate.
 */
class CLImate implements CLI
{
    /**
     * @var \League\CLImate\CLImate
     */
    private $cli;

    public function __construct()
    {
        $this->cli = new Provider;
    }

    /**
     * @inheritDoc
     */
    public function write(string $message, string $level = 'info'): void
    {
        switch ($level) {
            case 'warn':
                $colour = 'yellow';
                break;
            case 'error':
                $colour = 'red';
                break;
            case 'success':
                $colour = 'green';
                break;
            default:
                $colour = 'out';
        }

        $this->cli->$colour($message);
    }

    /**
     * @inheritDoc
     */
    public function ask($question): string
    {
        $input = $this->cli->input($question);
        return $input->prompt();
    }
}
