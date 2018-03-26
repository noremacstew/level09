<?php
/**
 * Created by PhpStorm.
 * User: stew
 * Date: 3/25/18
 * Time: 12:34 PM
 */

namespace level09\Structures;


abstract class Structure
{
    /**
     * Get a dynamic property for instance
     * @param $property
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function __get($property)
    {
        $this->ensurePropertyExists($property);
        return $this->getPropertyValue($property);
    }

    /**
     * Set a dynamic property for instance
     * @param $property
     * @param $value
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        $this->ensurePropertyExists($property);
//        if ( $this->propertyHasVars($property))
        $this->$property = $value;
    }

    /**
     * Get an array containing the instance data
     * @return array
     */
    public function getInstance()
    {
        $instance = array();
        foreach ( get_object_vars ( $this ) as $property )
            $instance[$property] = $this->$property;

        return $instance;
    }

    protected function getPropertyValue($property)
    {
//        if ( $this->propertyHasVars($property) )
//            return $this->getPropertyVars($property);

        return $this->$property;
    }

    /**
     * Throw an error if a property can't be accessed
     * @param $property
     * @throws \Exception
     */
    protected function ensurePropertyExists($property)
    {
        if (! property_exists( get_called_class(), $property ) )
            throw new \Exception("Data type " . get_called_class() . " has no property $property");
    }

    /**
     * Get a value from a property var
     * @todo this will change with var refactor
     * @param $property
     * @param $var
     * @return mixed
     */
//    protected function getPropertyVars($property)
//    {
////        $this->ensurePropertyHasVars($property);
//        return ${$this->$property}->retrieve();
//    }

    /**
     * Returns true if property has vars
     * @param $property
     * @return bool
     */
//    protected function propertyHasVars($property)
//    {
//        return in_array($property, $this->propertyVars);
//    }

    /**
     * Throw an error if a property doesn't have vars
     * @param $property
     * @throws \Exception
     */
//    protected function ensurePropertyHasVars($property)
//    {
//        if (! $this->propertyHasVars($property) )
//            throw new \Exception("Data type " . get_called_class() . " property $property is not appendable");
//    }

}