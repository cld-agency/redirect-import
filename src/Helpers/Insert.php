<?php

use CLD\RedirectImport\Interfaces\Craft;
use CLD\RedirectImport\Interfaces\CLI;

/**
 * Inserts re-directs.
 *
 * @param \CLD\RedirectImport\Interfaces\Craft $craftConnection
 * @param array                                $redirects
 *
 * @return int Number of insertions that occured.
 */
function Insert(Craft $craftConnection, array $redirects): int
{
    // Count how many items we insert.
    $insertions = 0;

    foreach ($redirects as $redirect) {
        $elementId = $craftConnection->createElement();
        $craftConnection->createSiteElement($elementId);
        $craftConnection->createRedirect($elementId, $redirect[0], $redirect[1]);
        $insertions++;
    }

    return $insertions;
}
