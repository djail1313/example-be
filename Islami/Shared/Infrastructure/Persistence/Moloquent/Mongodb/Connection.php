<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb;


use Exception;
use Jenssegers\Mongodb\Connection as BaseConnection;
use MongoDB\Driver\Exception\ConnectionTimeoutException;
use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\WriteConcern;
use Throwable;

class Connection extends BaseConnection
{

    /**
     * @var \Mongodb\Driver\Session
     */
    protected $session;

    /**
     * start a new database transaction from a new session
     */
    public function beginTransaction()
    {

        if ($this->transactions == 0) {
            try {
                $this->session = $this->getMongoClient()->startSession();
                $this->session->startTransaction([
                    'readConcern'  => new ReadConcern("snapshot"),
                    'writeConcern' => new WriteConcern(WriteConcern::MAJORITY)
                ]);
            } catch (ConnectionTimeoutException $e) {
                $this->session->endSession();
                $this->reconnect();
                $this->session = $this->getMongoClient()->startSession();
                $this->session->startTransaction([
                    'readConcern'  => new ReadConcern("snapshot"),
                    'writeConcern' => new WriteConcern(WriteConcern::MAJORITY)
                ]);

            }
        }

        $this->transactions++;

        $this->fireConnectionEvent('beganTransaction');
    }

    /**
     * Commit active database session transaction
     */
    public function commit()
    {
        if ($this->transactions == 1) {
            $this->session->commitTransaction();
        }

        --$this->transactions;

        $this->fireConnectionEvent('committed');
    }

    /**
     * Rollback the active database session transaction
     *
     */
    public function rollBack($toLevel = null)
    {
        if ($this->transactions == 1) {
            $this->session->abortTransaction();

        }

        $this->transactions = max(0, $this->transactions - 1);

        $this->fireConnectionEvent('rollingBack');
    }

    /**
     * @return \Mongodb\Driver\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    protected function causedByConcurrencyError(Exception $e)
    {
        return false;
    }

    protected function causedByLostConnection(Throwable $e)
    {
        if ($e instanceof ConnectionTimeoutException) {
            return true;
        }
        return false;
    }

}
