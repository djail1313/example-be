<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb\Query;

use Jenssegers\Mongodb\Query\Builder as BaseBuilder;

class Builder extends BaseBuilder
{

    /**
     * @inheritdoc
     */
    public function insertGetId(array $values, $sequence = null)
    {
        $options = [];
        $connection = $this->getConnection();
        if ($connection->transactionLevel() > 0)
            $options['session'] = $connection->getSession();

        $result = $this->collection->insertOne($values, $options);

        if (1 == (int)$result->isAcknowledged()) {
            if (is_null($sequence)) {
                $sequence = '_id';
            }

            // Return id
            return $sequence == '_id' ? $result->getInsertedId() : $values[ $sequence ];
        }
    }


    /**
     * @inheritdoc
     */
    public function insert(array $values)
    {
        // Since every insert gets treated like a batch insert, we will have to detect
        // if the user is inserting a single document or an array of documents.
        $batch = true;

        $options = [];

        foreach ($values as $value) {
            // As soon as we find a value that is not an array we assume the user is
            // inserting a single document.
            if (!is_array($value)) {
                $batch = false;
                break;
            }
        }

        if (!$batch) {
            $values = [$values];
        }

        $connection = $this->getConnection();
        if ($connection->transactionLevel() > 0)
            $options['session'] = $connection->getSession();
        // Batch insert
        $result = $this->collection->insertMany($values, $options);

        return (1 == (int)$result->isAcknowledged());
    }

    /**
     * @inheritdoc
     */
    public function delete($id = null)
    {
        $options = [];

        // If an ID is passed to the method, we will set the where clause to check
        // the ID to allow developers to simply and quickly remove a single row
        // from their database without manually specifying the where clauses.
        if (!is_null($id)) {
            $this->where('_id', '=', $id);
        }

        $connection = $this->getConnection();
        if ($connection->transactionLevel() > 0)
            $options['session'] = $connection->getSession();

        $wheres = $this->compileWheres();
        $result = $this->collection->DeleteMany($wheres, $options);
        if (1 == (int)$result->isAcknowledged()) {
            return $result->getDeletedCount();
        }

        return 0;
    }


    /**
     * @inheritdoc
     */
    protected function performUpdate($query, array $options = [])
    {
        // Update multiple items by default.
        if (!array_key_exists('multiple', $options)) {
            $options['multiple'] = true;
        }

        $connection = $this->getConnection();
        if ($connection->transactionLevel() > 0)
            $options = array_merge($options, ['session' => $connection->getSession()]);

        $wheres = $this->compileWheres();
        $result = $this->collection->UpdateMany($wheres, $query, $options);
        if (1 == (int)$result->isAcknowledged()) {
            return $result->getModifiedCount() ? $result->getModifiedCount() : $result->getUpsertedCount();
        }

        return 0;
    }

}
