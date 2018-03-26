<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix41;
use level09\Structures\EbootScript;

class Rail extends EbootScript
{
    /** @var  Matrix41 float 0-255 */
    protected $railColor;
    /** @var  bool */
    protected $closed;
    /** @var  array Matrix31 */
    protected $railDataPoints = array();

    protected $appendableProperties = array('railDataPoints');
}