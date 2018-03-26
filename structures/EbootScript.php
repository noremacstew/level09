<?php

namespace level09\Structures;

/**
 * Class EbootScript
 * @todo subclass property vars, instead of using an array
 * we could validate and describe data better
 *      DynamicNodeVars
 *      EnvNodeCloth
 *      EnvNodeSpecular
 * @todo subclass lists so we can extract append logic and validations
 *      ClumpInstanceObjects
 *      RailInstanceRailDataPoints
 * @todo need to subclass EnvNodeInstances somehow
 * @todo try to remove unused scripts
 *      SignData
 *      SignInstance
 *      StartLocation
 * @todo trigger instances need subtypes
 *
 * @package level09\Structures
 */
class EbootScript extends Structure
{
    /** @var  string */
    protected $objectName;
    /** @var  string */
    protected $objectGardener;
    /** @var  array string */
    protected $appendableProperties = array();
    /** @var  array string */
    protected $propertyVars = array();


    /**
     * Append to a dynamic property for instance
     * @param $property
     * @param $value
     * @throws \Exception
     */
    public function appendProperty($property, $value)
    {
        $this->ensureAppendableProperty($property);
        $this->$property[] = $value;
    }

    /** Private **/
    /**
     * Throw an error if a property can't be accessed, or if is not an array
     * @param $property
     * @throws \Exception
     */
    private function ensureAppendableProperty($property)
    {
        $this->ensurePropertyExists($property);
        if (! in_array( $property, $this->appendableProperties ) )
            throw new \Exception("Data type " . get_called_class() . " property $property is not appendable");
    }

//    /**
//     * Throw an error if a property can't be accessed, or the var isn't valid
//     * @todo this will change with property var refactor
//     * @param $property
//     * @param $var
//     * @throws \Exception
//     */
//    private function ensurePropertyVarExists($property, $var)
//    {
//        $this->ensurePropertyExists($property);
//        //@todo how should i test if a var exists? should i?
//        if (! in_array($var, $this->validPropertyVars[$property]))
//            throw new \Exception("Data type " . get_called_class() . " has no var $var in $property")
//    }
}