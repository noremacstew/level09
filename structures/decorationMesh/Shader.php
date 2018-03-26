<?php

namespace level09\Structures\DecorationMesh;

abstract class Shader
{
    /**
     * Set a dynamic property for instance
     * @param $property
     * @param $value
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        $this->ensurePropertyExists($property);
        $this->$property = $value;
    }

    /**
     * Get a dynamic property for instance
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        $this->ensurePropertyExists($property);
        return $this->$property;
    }

    /** Private **/
    /**
     * Throw an error if a property can't be accessed
     * @param $property
     * @throws \Exception
     */
    private function ensurePropertyExists($property)
    {
        if (! property_exists( get_called_class(), $property ) )
            throw new \Exception(get_called_class() . " has no property $property");
    }
}