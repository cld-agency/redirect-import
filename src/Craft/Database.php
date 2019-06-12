<?php

namespace CLD\RedirectImport\Craft;

use CLD\RedirectImport\Exceptions\OperationFailed;
use CLD\RedirectImport\Interfaces\Craft;
use CLD\RedirectImport\Interfaces\Database as DatabaseInterface;
use CLD\RedirectImport\Interfaces\UUID;

/**
 * Implements the Craft connector using our database connector.
 */
class Database implements Craft
{
    /**
     * @var \CLD\RedirectImport\Interfaces\Database
     */
    private $database;

    /**
     * @var \CLD\Clinimed\Interfaces\UUID
     */
    private $uuid;

    /**
     * Set-up.
     *
     * @param \CLD\RedirectImport\Interfaces\Database $database
     * @param \CLD\RedirectImport\Interfaces\UUID     $uuid
     */
    public function __construct(DatabaseInterface $database, UUID $uuid)
    {
        $this->database = $database;
        $this->uuid     = $uuid;
    }

    /**
     * @inheritDoc
     */
    public function createElement(): int
    {
        $result = $this->database->insert(
            'INSERT INTO ' . getenv('ELEMENT_TABLE') . ' (type, enabled, archived, dateCreated, dateUpdated, uid)
            VALUES (?, ?, ?, ?, ?, ?);',
            [
                'dolphiq\redirect\elements\Redirect',
                1,
                0,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                $this->uuid->generate(),
            ]
        );

        if (!$result) {
            throw new OperationFailed('Element creation failed');
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function createSiteElement(int $elementId): bool
    {
        $result = $this->database->insert(
            'INSERT INTO ' . getenv('SITE_ELEMENT_TABLE') . ' (elementId, siteId, enabled, dateCreated, dateUpdated, uid)
            VALUES (?, ?, ?, ?, ?, ?);',
            [
                $elementId,
                getenv('SITE_ID'),
                1,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                $this->uuid->generate(),
            ]
        );

        if (!$result) {
            throw new OperationFailed('Re-direct creation failed');
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function createRedirect(int $elementId, string $from, string $to): bool
    {
        $result = $this->database->insert(
            'INSERT INTO ' . getenv('REDIRECT_TABLE') . ' (id, sourceUrl, destinationUrl, statusCode, dateCreated, dateUpdated, uid)
            VALUES (?, ?, ?, ?, ?, ?, ?);',
            [
                $elementId,
                $from,
                $to,
                301,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                $this->uuid->generate(),
            ]
        );

        if (!$result) {
            throw new OperationFailed('Re-direct creation failed');
        }

        return true;
    }
}
