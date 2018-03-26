<?php

namespace level09\Structures\EbootScript;
use level09\Lib\Datatypes\Matrix\Matrix31;
use level09\Structures\EbootScript;

class SoundEmitter extends EbootScript
{
    /** @var  Matrix31 float */
    protected $position;
    /** @var  bool */
    protected $enabled;
    /** @var  string */
    protected $soundName;
    /** @var  string LvlMus, LvlSfx, SharSfx */
    protected $bankName;
    /** @var  int ? 1 ? */
    protected $volume;
    /** @var  int ? 0 ? only star has 1 */
    protected $dopplerMult;
    /** @var  bool */
    protected $is3D;
    /** @var  int 1 - ?; only painting reveal is 1, most 10+ */
    protected $minDist;
    /** @var  int 10 - 500 ? */
    protected $fadeDist;
    /** @var  bool true ? */
    protected $autoPitch;
    /** @var  bool */
    protected $followSwarm;
}