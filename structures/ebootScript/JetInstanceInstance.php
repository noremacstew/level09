<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;
use level09\Lib\Datatypes\Matrix\Matrix41;
use level09\Structures\EbootScript;

class Jet extends EbootScript
{
    /** @var  Matrix31 float */
    protected $position;
    /** @var  Matrix41 float */
    protected $quaternion;
    /** @var  int ? 1 ? */
    protected $radius;
    /** @var  bool */
    protected $enabled;
    /** @var  int ? 0 ? */
    protected $pulseFrequency;
    /** @var  float */
    protected $push;
    /** @var  int ? 0 ? */
    protected $sink;
    /** @var  float */
    protected $mass;
}