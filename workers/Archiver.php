<?php

namespace level09\Workers;
use level09\Drivers\Driver;
use level09\Tools\Tool;

/**
 * Archiver is responsible for making backups before output
 * @package level09\Workers
 */
class Archiver extends Worker
{
    /** @var string */
    protected $source;
    /** @var string */
    protected $target;
    /** @var  Tool */
    protected $tool;
    /** @var  string */
    protected $level;

    public function work()
    {
        $this->tool->loadDriver('source', $this->source);
        //load target location from config
//        $this->tool->loadDriver('target', $this->target);

        //@todo package existing file somehow
    }
}