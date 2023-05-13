<?php

namespace App\Repositories;

use App\Models\Interfaces\ModelInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;


abstract class Repository implements RepositoryInterface
{
    /**
     * @var ModelInterface
     */
    protected $modelClass;

    /**
     * @var Connection
     */
    protected $dbConn;

    public function __construct()
    {
        $modelClassName = $this->model();
        $this->modelClass = new $modelClassName;
        $this->dbConn = DriverManager::getConnection([
            'dbname' => env('DB_NAME'),
            'user' => env('DB_USER'),
            'password' => env('DB_PASS'),
            'host' => env('DB_HOST'),
            'driver' => env('DB_DRIVER'),
        ]);

        unset($modelClassName);
    }

    /**
     * @return string
     */
    abstract protected function model();

    protected function newQuery()
    {
        return $this->dbConn
            ->createQueryBuilder()
            ->from($this->modelClass->getTable());
    }

    protected function getCollection(QueryBuilder $query)
    {
        return collect_as(
            $query->select('*')->fetchAllAssociative(),
            $this->model()
        );
    }

    protected function getRecord(QueryBuilder $query)
    {
        $recordResults = $query->select('*')->fetchOne();
        if (empty($recordResults)) {
            return null;
        }

        return $this->modelClass->setAttributes($recordResults);
    }

    protected function appendParameterForSearch(QueryBuilder &$query, $attribute, $value)
    {
        $query
            ->where("$attribute = :$attribute")
            ->setParameter($attribute, $value);
        unset($attribute);
        unset($value);
    }

    protected function appendParameterForValues(QueryBuilder &$query, $attributeValues, $forUpdate = false)
    {
        $setMethod = $forUpdate ? 'set' : 'setValue';
        foreach ($attributeValues as $attribute => $value) {
            $query->{$setMethod}($attribute, ":$attribute");
            $query->setParameter($attribute, $value);
        }
        unset($setMethod);
        unset($attributeValues);
        unset($forUpdate);
    }

    protected function getQueryForMultipleSearch(array $searchParameters, QueryBuilder $query = null)
    {
        $query = is_null($query) ? $this->newQuery() : $query;
        foreach ($searchParameters as $attribute => $value) {
            $this->appendParameterForSearch($query, $attribute, $value);
        }
        unset($searchParameters);

        return $query;
    }

    public function all()
    {
        return $this->getCollection(
            $this->newQuery()
        );
    }

    public function findByAttribute($attribute, $value)
    {
        return $this->getRecord(
            $this->newQuery()
                ->where("$attribute = :$attribute")
                ->setParameter($attribute, $value)
        );
    }

    public function findById($id)
    {
        return $this->findByAttribute($this->modelClass->getPrimaryKey(), $id);
    }

    public function search(array $searchParameters)
    {
        return $this->getCollection(
            $this->getQueryForMultipleSearch($searchParameters)
        );
    }

    public function deleteByAttribute($attribute, $value)
    {
        $this->dbConn
            ->createQueryBuilder()
            ->delete($this->modelClass->getTable())
            ->where("$attribute = :$attribute")
            ->setParameter($attribute, $value)
            ->executeQuery();
    }

    public function deleteById($id)
    {
        $this->deleteByAttribute(
            $this->modelClass->getPrimaryKey(),
            $id
        );
    }

    public function searchAndDelete(array $searchParameters)
    {
        $this->getQueryForMultipleSearch(
            $searchParameters,
            $this->dbConn
                ->createQueryBuilder()
                ->delete($this->modelClass->getTable())
        )->executeQuery();
    }

    public function create(array $attributes)
    {
        $query = $this->dbConn
            ->createQueryBuilder()
            ->insert($this->modelClass->getTable());
        $this->appendParameterForValues($query, $attributes);
        $query->executeQuery();
    }

    public function update(array $searchParameters, array $updateParameters)
    {
        $query = $this->getQueryForMultipleSearch(
            $searchParameters,
            $this->dbConn
                ->createQueryBuilder()
                ->update($this->modelClass->getTable())
        );
        $this->appendParameterForValues($query, $updateParameters, true);
        $query->executeQuery();
    }
}