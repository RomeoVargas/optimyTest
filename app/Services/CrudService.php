<?php


namespace App\Services;


use App\Repositories\Interfaces\RepositoryInterface;

class CrudService
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function findByAttribute($attribute, $value)
    {
        return $this->repository->findByAttribute($attribute, $value);
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function search(array $searchParameters)
    {
        return $this->repository->search($searchParameters);
    }

    public function deleteByAttribute($attribute, $value)
    {
        $this->repository->deleteByAttribute($attribute, $value);
    }

    public function deleteById($id)
    {
        $this->repository->deleteById($id);
    }

    public function searchAndDelete(array $searchParameters)
    {
        $this->repository->searchAndDelete($searchParameters);
    }

    public function create(array $attributes)
    {
        $this->repository->create($attributes);
    }

    public function update(array $searchParameters, array $updateParameters)
    {
        $this->repository->update($searchParameters, $updateParameters);
    }
}