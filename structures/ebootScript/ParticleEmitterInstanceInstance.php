<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;
use level09\Lib\Datatypes\Matrix\Matrix44;
use level09\Structures\EbootScript;

class ParticleEmitter extends EbootScript
{
    /** @var  Matrix31 float */
    protected $position;
    /** @var  Matrix44 float */
    protected $transformation;
    /** @var  string typeName */
    protected $emitterType;
    /** @var  bool */
    protected $enabled;
    /** @var  Matrix31 float */
    protected $targetPos;
    /** @var  bool */
    protected $followCamera;
    /** @var  bool false ? */
    protected $forceCache;
    /** @var  Matrix31 {0,0,0} ? */
    protected $cameraOffset;
    /** @var  int ? 1 ? */
    protected $camLeadMult;
    /** @var  int ? 0 ? */
    protected $windHullBlendVel;
    /** @var  int ? 0 ? */
    protected $windHullBlendDir;
    /** @var  bool */
    protected $followLocal;
    /** @var  bool false ? */
    protected $followRemote;
    /** @var  bool */
    protected $targetLocal;
    /** @var  bool false ? */
    protected $targetRemote;
    /** @var  bool false ? */
    protected $killParticlesOnDisable;
    /** @var  string jointName */
    protected $targetJoint;
}