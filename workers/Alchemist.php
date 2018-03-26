<?php

namespace level09\Workers;
use level09\Tools\Tool;

/**
 * Alchemist is responsible for transforming input format to output format
 * @package level09\Workers
 */
class Alchemist extends Worker
{
    /** @var string */
    protected $source;
    /** @var string */
    protected $target;
    /** @var Tool */
    protected $tool;
    /** @var  string */
    protected $level;

    /**
     * @param null $data
     * @return mixed
     */
    public function work()
    {
        $this->tool->loadDriver('source', $this->source);
        $this->tool->loadDriver('target', $this->target);
        if($this->level)
            $this->tool->setLevel($this->level);

        $this->tool->transmute();

        // if we have ebootscripts, do we assume we use all files for best compression?
    }
}