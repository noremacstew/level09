<?php

namespace level09\Workers;

/**
 * Abstract Class Worker
 * @package level09\Workers
 */
abstract class Worker
{
    /**
     * Set a dynamic property for instance
     * @param $property
     * @param $value
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        if($property == 'levels') {
            $this->$property = $value;
        }
        if($property == 'tool') {
            $propertyName = $value . ucfirst($property);
            $this->$property = new $propertyName();
        } else {
            $this->$property = $value;
        }
    }

    /**
     * Do your job
     * @param null $data
     */
    abstract public function work();
}