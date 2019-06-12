<?php

namespace CLD\RedirectImport\Interfaces;

/**
 * Defines functions required to interface with Craft.
 */
interface Craft
{
    /**
     * Create the element record.
     *
     * @return int ID of the inserted element.
     */
    public function createElement(): int;

    /**
     * Create a craft_elements_sites record.
     *
     * @param int $elementId ID of the element this Site Element belongs to.
     * @param int $siteId    ID of the site the element belongs to.
     *
     * @return bool
     */
    public function createSiteElement(int $elementId, int $siteId = 1): bool;

    /**
     * Create a redirect record.
     *
     * @param int    $element The element ID.
     * @param string $from    Path to re-direct from.
     * @param string $to      Path to re-direct to.
     *
     * @return bool
     */
    public function createRedirect(int $elementId, string $from, string $to): bool;
}
