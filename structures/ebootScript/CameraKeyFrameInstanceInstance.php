<?php

namespace level09\Structures\EbootScript;
use level09\Structures\EbootScript;
use level09\lib\Datatypes\Matrix\Matrix31;
use level09\lib\Datatypes\Matrix\Matrix44;

class CameraKeyFrame extends EbootScript
{
    /** @var  Matrix31 float */
    protected $position;
    /** @var  Matrix31 float */
    protected $rotation;
    /** @var  Matrix44 float */
    protected $transformation;
    /** @var  float */
    protected $fov;
    /** @var  int ? */
    protected $dofDistance;
    /** @var  int ? */
    protected $dofFocusRadius;
    /** @var  int ? */
    protected $dofTransitionMult;
    /** @var  int ? */
    protected $dofIntensity;
    /** @var  int ? */
    protected $motionBlurIntensity;
    /** @var  Matrix31 int ?*/
    protected $panDirection;
    /** @var  float ? */
    protected $panSpeed;
    /** @var  int ? */
    protected $groupID;
    /** @var  bool */
    protected $allowInPauseMode;
}