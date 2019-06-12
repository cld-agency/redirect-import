<?php

namespace CLD\RedirectImport\Interfaces;

interface CLI
{
    /**
     * Write to the CLI.
     *
     * @param string $message Message to output to the CLI. No \n required.
     * @param string $level   Valid: 'info', 'warn', 'error', 'success'.
     *                        Default: 'info'.
     *
     * @return void
     */
    public function write(string $message, string $level = 'info'): void;

    /**
     * Request input from the user.
     *
     * @param string $question The question to request a repsonse for.
     *
     * @return string The answer.
     */
    public function ask($question): string;
}
