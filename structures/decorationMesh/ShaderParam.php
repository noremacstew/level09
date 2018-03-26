<?php

namespace level09\Structures\DecorationMesh;

class ShaderParam
{
    /** @var int 100000     this isn't in the source file, but is hardcoded in the script */
    protected $unknown;
    /** @var  string */
    protected $name;
    /** @var  mixed */
    protected $values;

    public function __construct($name, $values, $unknown=100000)
    {
        $this->name = $name;
        $this->values = $values;    // this default case should work for ints, floats, bools and strings
        $this->unknown = 100000;
    }

    public function getValues()
    {
        return array($this->name => $this->values);
    }
}