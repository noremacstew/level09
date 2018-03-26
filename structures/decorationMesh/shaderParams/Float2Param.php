<?php

namespace level09\Structures\DecorationMesh\ShaderParam;
use level09\Structures\DecorationMesh\ShaderParam;
use level09\Lib\Datatypes\Matrix\Matrix41;

/**
 * Class Float2Param
 * Store a 4x1 matrix of floats, using first 2 $values and zeroes
 * @package level09\Structures\ShaderParams
 */
class Float2Param extends ShaderParam
{
    public function __construct($name, $values, $unknown=100000)
    {
        parent::__construct($name, $values, $unknown=100000);
        $this->values = new Matrix41(array($values[0], $values[1], 0, 0));
    }
}