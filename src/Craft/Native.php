<?php

namespace CLD\RedirectImport\Craft;

use CLD\RedirectImport\Interfaces\UUID;

/**
 * Inserts records into Craft's database.
 */
class Native
{
    /**
     * @return integer
     */
    private $uuid;

    /**
     * Set-up.
     *
     * @param \CLD\RedirectImport\Interfaces\UUID
     */
    public function __construct(UUID $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Create the element record.
     *
     * @return int ID of the inserted element.
     */
    public function createElement(): int
    {
        \Craft::$app->db->createCommand()
            ->insert(getenv('DB_TABLE_PREFIX') . 'elements', [
                'type'        => 'dolphiq\redirect\elements\Redirect',
                'enabled'     => true,
                'archived'    => false,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateUpdated' => date('Y-m-d H:i:s'),
                'uid'         => $this->uuid->generate(),
            ])->execute();

        return \Craft::$app->db->getLastInsertID();
    }

    /**
     * Create a elements_sites record.
     *
     * @param int $elementId ID of the element this Site Element belongs to.
     * @param int $siteId    ID of the site the element belongs to.
     *
     * @return bool
     */
    public function createSiteElement(int $elementId, int $siteId = 1): bool
    {
        \Craft::$app->db->createCommand()
            ->insert(getenv('DB_TABLE_PREFIX') . 'elements_sites', [
                'elementId'   => $elementId,
                'siteId'      => $siteId,
                'enabled'     => true,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateUpdated' => date('Y-m-d H:i:s'),
                'uid'         => $this->uuid->generate(),
            ])->execute();

        return true;
    }

    /**
     * Create a redirect record.
     *
     * @param int    $element The element ID.
     * @param string $from    Path to re-direct from.
     * @param string $to      Path to re-direct to.
     *
     * @return bool
     */
    public function createRedirect(int $elementId, string $from, string $to): bool
    {
        \Craft::$app->db->createCommand()
            ->insert(getenv('DB_TABLE_PREFIX') . 'dolphiq_redirects', [
                'id'             => $elementId,
                'sourceUrl'      => $from,
                'destinationUrl' => $to,
                'statusCode'     => 301,
                'dateCreated'    => date('Y-m-d H:i:s'),
                'dateUpdated'    => date('Y-m-d H:i:s'),
                'uid'            => $this->uuid->generate(),
            ])->execute();

        return true;
    }
}
