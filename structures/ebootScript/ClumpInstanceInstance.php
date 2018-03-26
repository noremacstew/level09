<?php

namespace level09\Structures\EbootScript;
use level09\Structures\EbootScript;

class Clump extends EbootScript
{
    /** @var  array string objectNames */
    /** @todo refactor into a subclass ? */
    protected $objects = array();

    protected $appendableProperties = array('objects');
}