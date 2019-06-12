<?php

use CLD\RedirectImport\Interfaces\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet as Reader;

/**
 * Get the file reader.
 *
 * @param string $file
 *
 * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
 */
function getReader(string $file, Spreadsheet $spreadsheetReader): Reader
{
    // DANGEROUS!
    // I'm setting an infinite time limit and massive memory limit as a big
    // file is being imported.
    set_time_limit(0);
    ini_set('memory_limit', '4G');

    $reader = $spreadsheetReader->read($file);
    return $reader;
}
