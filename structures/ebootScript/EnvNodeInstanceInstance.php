<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix41;
use level09\Structures\EbootScript;

class EnvNode extends EbootScript
{
    /** @var  bool */
    protected $isZNode;
    /** @var  bool */
    protected $enabled;
    /** @var  int 1 ? */
    protected $shadowLength;
    /** @var  int 1 ? */
    protected $shadowAlpha;
    /** @var  int -30,15 */
    protected $fogStart;
    /** @var  int 5,205 */
    protected $fogEnd;
    /** @var  Matrix41 float 0,255 */
    protected $fogCloseColor;
    /** @var  Matrix41 float 0,255 */
    protected $fogFarColor;
    /** @var  Matrix41 float 0,255 */
    protected $fogCloseAlpha;
    /** @var  float */
    protected $fogFarAlpha;
    /** @var  int ? */
    protected $fogHeightStart;
    /** @var  int ? */
    protected $fogHeightEnd;
    /** @var  Matrix41 float 0,255 */
    protected $skyMinColor;
    /** @var  Matrix41 float 0,255 */
    protected $skyLowColor;
    /** @var  Matrix41 float 0,255 */
    protected $skyMidColor;
    /** @var  Matrix41 float 0,255 */
    protected $skyHighColor;
    /** @var  Matrix41 float 0,255 */
    protected $skyMaxColor;
    /** @var  float 0,1 */
    protected $skyLowHeight;
    /** @var  float 0,1 */
    protected $skyMidHeight;
    /** @var  float 0,1 */
    protected $skyHighHeight;
    /** @var  float 0,1 ? */
    protected $bloomSize;
    /** @var  float 0,1 ? */
    protected $bloomIntensity;
    /** @var  float 0,1 ? */
    protected $bloomOverbright;
    /** @var  int 0 ? */
    protected $chromaticAberration;
    /** @var  int 0,100 ? */
    protected $velvetRatio;
    /** @var  float 0,1 ? */
    protected $velvetInt;
    /** @var  EnvNodeSpecular */
    protected $env;
    /** @var  EnvNodeCloth|null sometimes isn't used, i think for hl */
    protected $cloth;
    /** @var  EnvNodeCloth|null sometimes isn't used, i think for hl */
    protected $player;

    /** @var  array @todo this validPropertyVars shouldn't be necessary anymore */
    protected $validPropertyVars    = array(
        'env' => 'EnvNodeSpecular',
        'cloth' => 'EnvNodeCloth',
        'player' => 'EnvNodeCloth'
    );



/*
 * @todo should subclass envnodes?...
  when isZNode
  , Radius = 30
  , ZPos = -38.6875

  when not isZNode
  , FadeDuration = 0
  , MinBoundingBox = { ObjectName = "6c6f35d63f237b4069cab00d6cd79745"
                     , GardenerName = "|EnvVolume40|MinBoundingBox"
                     , Position = {256.156, 44.8766, 686.225}
                     , Extent = {27.5, 27.5, 27.5}
                     }
  , MaxBoundingBox = { ObjectName = "83d55e0a69b93e5bb91eca7b485f0348"
                     , GardenerName = "|EnvVolume40|MaxBoundingBox"
                     , Position = {256.156, 44.8766, 686.225}
                     , Extent = {30, 30, 30}
                     }
 */
}