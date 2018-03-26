<?php

namespace level09\Structures\EbootScript;
use level09\Structures\EbootScript;

class Trigger extends EbootScript
{
    /** @var  string triggerType */
    protected $type;
    /** @var  string */
    protected $shortcut;
    /** @var  TriggerVars */
    protected $vars;
}