<?php

namespace level09\Structures\EbootScript;
use level09\Structures\EbootScript;

class Timeline extends EbootScript
{
    /** @var  array triggers */
    /** @todo subclass list */
    protected $triggers;
    /** @var  int ? */
    protected $length;
    /** @var  int ? */
    protected $loopStart;
    /** @var  int ? */
    protected $loopEnd;
    /** @var  int ? -1 if can't pause? */
    protected $pauseTime;
    /** @var  bool */
    protected $looping;
    /** @var  bool */
    protected $nonGracefulLooping;
    /** @var  string */
    protected $name;
/*
    { { TriggerName = "0b1ab24226d003d9441d08773b24d7a8", Time = 0.0986569 }
    , { TriggerName = "323faa4de75ae590b1a43b2c0eb314b3", Time = 8.52651e-014 }
 */
}