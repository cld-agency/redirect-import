<?php

namespace CLD\RedirectImport\Craft;

use CLD\RedirectImport\Interfaces\Craft;
use CLD\RedirectImport\Interfaces\UUID;

/**
 * Implement the Craft interface with Craft's native methods.
 */
class Native implements Craft
{
    /**
     * Undocumented function
     *
     * @return integer
     */
    private $uuid;

    /**
     * Set-up.
     *
     * @param \CL
     */
    public function __construct(UUID $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
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
     * @inheritDoc
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
