<?php

namespace CLD\RedirectImport\controllers;

use craft\web\Controller;
use craft\web\UploadedFile;
use CLD\RedirectImport\Craft\Native;

class CpController extends Controller
{
    /**
     * @var array
     */
    private $validMimeTypes = ['text/csv'];

    /**
     * Handle an import upload.
     *
     * @return void Fall through to Craft's request handling.
     */
    public function actionImport(): void
    {
        if (empty($_FILES)
            or !file_exists($_FILES['redirect_file']['tmp_name'])
            or !is_uploaded_file($_FILES['redirect_file']['tmp_name'])
            or $_FILES['redirect_file']['error'] !== 0
            or !in_array($_FILES['redirect_file']['type'], $this->validMimeTypes)) {
            return;
        }

        // Get the CSV as an array.
        $contents = array_map('str_getcsv', file($_FILES['redirect_file']['tmp_name']));
        array_shift($contents); // TODO: Allow first row being a heading row to be toggled.

        // Loop through and insert.
        $craftConnection = new Native;
        $insertions      = 0;

        foreach ($contents as $redirect) {
            $elementId = $craftConnection->createElement();
            $craftConnection->createSiteElement($elementId);
            $craftConnection->createRedirect($elementId, $redirect[0], $redirect[1]);
            $insertions++;
        }

        // TODO: Add success message.
    }
}
