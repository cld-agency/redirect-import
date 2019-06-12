<?php

namespace CLD\RedirectImport\Craft;

use CLD\RedirectImport\Interfaces\Craft;

/**
 * Implement the Craft interface with Craft's native methods.
 */
class Native implements Craft
{
    /**
     * @inheritDoc
     */
    public function createElement(): int
    {
        $result = craft()->db->createCommand()
            ->insert('', []);

        var_dump($result);
        die;
    }

    /**
     * @inheritDoc
     */
    public function createSiteElement(int $elementId, int $siteId = 1): bool
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function createRedirect(int $elementId, string $from, string $to): bool
    {
        //
    }
}
