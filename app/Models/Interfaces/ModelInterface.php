<?php


namespace App\Models\Interfaces;


interface ModelInterface
{
    public function setAttribute($attribute, $value);
    public function getAttribute($attribute);
    public function setAttributes(array $attributes);
    public function getAttributes(array $attributes);
    public function getTable();
    public function getPrimaryKey();
}