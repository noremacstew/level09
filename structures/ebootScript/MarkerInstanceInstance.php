<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;
use level09\Lib\Datatypes\Matrix\Matrix41;
use level09\Structures\EbootScript;

class Marker extends EbootScript
{
    /** @var  Matrix31 */
    protected $position;
    /** @var  Matrix41 */
    protected $quaternion;
    /** @var  Matrix31 */
    protected $scale;
    /** @var  bool true ? */
    protected $enabled;
}