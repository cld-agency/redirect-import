<?php

namespace CLD\RedirectImport\Interfaces;

/**
 * This is fairly coupled to PDO and won't work with other DBAs very easily.
 */
interface Database
{
    /**
     * Run a prepared statement, for example: https://phpdelusions.net/pdo#prepared
     *
     * @param string $statement The statement to execute.
     * @param array  $args      Arguments to pass into the statement.
     *
     * @return mixed
     */
    public function prepared(string $statement, array $args = []);

    /**
     * Run a query.
     *
     * @param string $query
     *
     * @return mixed
     */
    public function query(string $query);

    /**
     * Insert a new row.
     *
     * @param string $statement The statement to execute.
     * @param array  $args      Arguments to pass into the statement.
     *
     * @return mixed Boolean FALSE if insert failed or the ID of the last
     *               inserted row.
     */
    public function insert(string $statement, array $args = []);

    /**
     * Update a record.
     *
     * @param string $statement The statement to execute.
     * @param array  $args      Arguments to pass into the statement.
     *
     * @return bool TRUE if the operation was successful, or FALSE.
     */
    public function update(string $statement, array $args): bool;
}
