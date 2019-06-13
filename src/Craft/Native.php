<?php

namespace CLD\RedirectImport\Craft;

use dolphiq\redirect\elements\Redirect;

/**
 * Inserts records into Craft's database.
 */
class Native
{
    /**
     * Create a redirect record.
     *
     * @param int    $siteId ID of the site the re-direct applies to.
     * @param string $from   Path to re-direct from.
     * @param string $to     Path to re-direct to.
     *
     * @return bool
     */
    public function createRedirect(int $siteId, string $from, string $to): bool
    {
        $entry                 = new Redirect;
        $entry->siteId         = $siteId;
        $entry->sourceUrl      = $from;
        $entry->destinationUrl = $to;
        $entry->statusCode     = 301;

        \Craft::$app->elements->saveElement($entry);
        return true;
    }
}
