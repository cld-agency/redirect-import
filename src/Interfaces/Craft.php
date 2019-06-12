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
     * @return int Insert ID.
     * @throws \CLD\RedirectImport\Exceptions\OperationFailed
     */
    public function createElement(): int;

    /**
     * Create a craft_elements_sites record.
     *
     * @param int $elementId
     *
     * @return bool
     * @throws \CLD\RedirectImport\Exceptions\OperationFailed
     */
    public function createSiteElement(int $elementId): bool;

    /**
     * Create a redirect record.
     *
     * @param int    $element The element ID.
     * @param string $from    Path to re-direct from.
     * @param string $to      Path to re-direct to.
     *
     * @return bool
     * @throws \CLD\RedirectImport\Exceptions\OperationFailed
     */
    public function createRedirect(int $elementId, string $from, string $to): bool;
}
