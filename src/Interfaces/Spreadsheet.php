<?php

namespace CLD\RedirectImport\Interfaces;

use PhpOffice\PhpSpreadsheet\Spreadsheet as Provider;

/**
 * Provides an interface to load files into memory. This will sadly be tightly
 * coupled to PhpSpreadsheet, but there's no standard to reading spreadsheets
 * (as far as I know, can't say I've checked) so that's unavoidable.
 */
interface Spreadsheet
{
    /**
     * Load a file.
     *
     * @param string $file Full path to the file to load.
     *
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet   The object that can be used to read the supplied file.
     * @throws \ClinimedImport\Exceptions\NotFound When the provided source file is missing.
     * @throws \ClinimedImport\Exceptions\CantHandle   Unrecognised file extenion.
     */
    public function read(string $file): Provider;
}
