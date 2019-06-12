<?php

namespace CLD\RedirectImport\Spreadsheet;

use CLD\RedirectImport\Interfaces\Spreadsheet;
use CLD\Exceptions\NotFound;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet as Provider;

class PhpSpreadsheet implements Spreadsheet
{
    /**
     * @inheritDoc
     */
    public function read(string $file): Provider
    {
        if (!file_exists($file)) {
            throw new NotFound;
        }

        return IOFactory::load($file);
    }
}
