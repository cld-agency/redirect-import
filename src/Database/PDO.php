<?php

namespace CLD\RedirectImport\Database;

use CLD\RedirectImport\Exceptions\CantConnect;
use CLD\RedirectImport\Exceptions\OperationFailed;
use CLD\RedirectImport\Interfaces\Database;

class PDO implements Database
{
    /**
     * The database connection.
     *
     * @var \PDO
     */
    private $connection;

    /**
     * Connect to the database.
     */
    public function __construct()
    {
        try {
            $dsn = empty(getenv('DB_SOCKET'))
                ? sprintf("mysql:host=%s;dbname=%s", getenv('DB_HOST'), getenv('DB_NAME'))
                : sprintf("mysql:unix_socket=%s;dbname=%s", getenv('DB_SOCKET'), getenv('DB_NAME'));

            $this->connection = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            throw new CantConnect($exception->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function prepared(string $statement, array $args = [])
    {
        $statement = $this->connection->prepare($statement);
        $statement->execute(!empty($args) ? $args : null);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @inheritDoc
     */
    public function query(string $query)
    {
        $result = $this->connection->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @inheritDoc
     */
    public function insert(string $statement, array $args = [])
    {
        try {
            $statement = $this->connection->prepare($statement);
            $statement->execute(!empty($args) ? $args : null);
        } catch (OperationFailed $e) {
            return false;
        }

        // Note that if we're inserting into tables where the ID is no auto-
        // incremented then this will always return 0.
        return $this->connection->lastInsertId();
    }

    /**
     * @inheritDoc
     */
    public function update(string $statement, array $args): bool
    {
        try {
            $statement = $this->connection->prepare($statement);
            $statement->execute($args);
        } catch (\PDOException $e) {
            return false;
        } catch (OperationFailed $e) {
            return false;
        }

        return true;
    }
}
