<?php

namespace level09\Structures\ShaderParams;
use level09\Structures\DecorationMesh\ShaderParam;
use level09\Lib\Datatypes\Matrix\Matrix41;

/**
 * Class Float4Param
 * Store a 4x1 matrix of floats from $values
 * @package level09\Structures\ShaderParams
 */
class Float4Param extends ShaderParam
{
    public function __construct($name, $values, $unknown=100000)
    {
        parent::__construct($name, $values, $unknown=100000);
        $this->values = new Matrix41($values[0], $values[1], $values[2], $values[3]);
    }
}