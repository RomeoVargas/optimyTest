<?php


namespace App\Models;


use App\Models\Interfaces\ModelInterface;
use Doctrine\Inflector\InflectorFactory;

abstract class Model implements ModelInterface
{
    protected $table;
    protected $primaryKey = 'id';

    // Fields that are acceptable for this model
    protected $attributes = [];

    public function __construct($attributes = [])
    {
        if (!empty($attributes)) {
            $this->setAttributes($attributes);
        }
    }

    private function validateIfAttributeExists($attribute)
    {
        if (!in_array($attribute, $this->attributes)) {
            throw new \Exception('Invalid attribute for this model');
        }
    }

    public function setAttribute($attribute, $value)
    {
        $this->validateIfAttributeExists($attribute);
        $this->{$attribute} = $value;

        return $this;
    }

    public function getAttribute($attribute)
    {
        $this->validateIfAttributeExists($attribute);

        return isset($this->{$attribute})
            ? $this->{$attribute}
            : null;
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    public function getAttributes(array $attributes)
    {
        $attributeValues = [];
        foreach ($attributes as $attribute) {
            $attributeValues[$attribute] = $this->getAttribute($attribute);
        }

        return $attributeValues;
    }

    public function getTable()
    {
        if (!empty($this->table)) {
            return $this->table;
        }

        $inflector = InflectorFactory::create()->build();
        $className = explode('\\', get_called_class());
        $classNameWithoutNamespace = end($className);

        return strtolower(
            $inflector->pluralize($classNameWithoutNamespace)
        );
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
}