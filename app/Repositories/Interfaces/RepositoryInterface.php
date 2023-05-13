<?php


namespace App\Repositories\Interfaces;


interface RepositoryInterface
{
    public function all();

    public function findByAttribute($attribute, $value);
    public function findById($id);
    public function search(array $searchParameters);

    public function deleteByAttribute($attribute, $value);
    public function deleteById($id);
    public function searchAndDelete(array $searchParameters);
    
    public function create(array $attributes);
    public function update(array $searchParameters, array $updateParameters);
}