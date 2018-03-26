<?php

namespace level09\Structures\ShaderParams;
use level09\Structures\DecorationMesh\ShaderParam;

/**
 * Class Float3Param
 * Store a 4x1 matrix of floats, using first 3 $values and a zero
 * @package level09\Structures\ShaderParams
 */
class Float3Param extends ShaderParam
{
    public function __construct($name, $values, $unknown=100000)
    {
        parent::__construct($name, $values, $unknown=100000);
        $this->values = new Matrix41(array($values[0], $values[1], $values[2], 0));
    }
}