<?php

use CLD\RedirectImport\Interfaces\CLI;

/**
 * Get the file's location from the user.
 *
 * @return string
 */
function getFileLocation(CLI $cli): string
{
    $cli->write('Enter the path to the file. The path can be absolute or relative to the root of this program.');
    $file = $cli->ask('Where\'s the file?');
    if (substr(0, 1) !== '/') {
        // We have a relative path. Assume the root of the path is the root
        // of this program.
        $file = __DIR__ . '/../../' . $file;
    }

    return realpath($file);
}
