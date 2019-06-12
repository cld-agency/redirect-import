<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Prepare the read file for processing.
 *
 * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
 *
 * @return array
 */
function prepareFile(Spreadsheet $spreadsheet): array
{
    $worksheet = $spreadsheet->getActiveSheet();

    // It's a bit memory heavy at ~1k per cell, so delete $spreadsheet.
    unset($spreadsheet);

    // Get rows as an array.
    $rows = $worksheet->toArray();
    return $rows;
}
