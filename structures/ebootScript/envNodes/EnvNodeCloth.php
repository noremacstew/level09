<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;

class EnvNodeCloth
{
    /** @var  bool */
    protected $pointLight;
    /** @var  Matrix31 */
    protected $lightDir;
    /** @var  bool */
    protected $ignoreLightDir;
    /** @var  Matrix31 float 0,1 */
    protected $lightColor;
    /** @var  float */
    protected $lightInt;
    /** @var  Matrix31 int 0,1 */
    protected $ambientColor;
    /** @var  float */
    protected $ambientInt;
}