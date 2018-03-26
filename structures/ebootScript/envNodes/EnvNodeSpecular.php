<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;

class EnvNodeSpecular extends EnvNodeCloth
{
    /** @var  Matrix31 float 0,1 ? */
    protected $specularColor;
    /** @var  int 1 ? */
    protected $specularInt;
    /** @var  int ? */
    protected $specularPower;
}