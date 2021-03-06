<?php

namespace MongoDB\Operation;

use MongoDB\DeleteResult;
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;

/**
 * Operation for deleting a single document with the delete command.
 *
 * @api
 * @see \MongoDB\Collection::deleteOne()
 * @see http://docs.mongodb.org/manual/reference/command/delete/
 */
class DeleteOne implements Executable
{
    private $delete;

    /**
     * Constructs a delete command.
     *
     * Supported options:
     *
     *  * collation (document): Collation specification.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $filter         Query by which to delete documents
     * @param array        $options        Command options
     * @throws InvalidArgumentException
     */
    public function __construct($databaseName, $collectionName, $filter, array $options = [])
    {
        $this->delete = new Delete($databaseName, $collectionName, $filter, 1, $options);
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
     * @param Server $server
     * @return DeleteResult
     * @throws UnsupportedException if collation is used and unsupported
     */
    public function execute(Server $server)
    {
        return $this->delete->execute($server);
    }
}
