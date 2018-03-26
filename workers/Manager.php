<?php

namespace level09\Workers;

/**
 * The manager is responsible for coordinating between workers
 * @todo we can loop through different jobs here, like hull + decomesh + eboot
 * @package level09\Workers
 */
class Manager extends Worker
{
    /** @var Alchemist */
    private $alchemist;
    /** @var Archiver */
    private $archiver;
    /** @var array string */
    private $levels;

    /**
     * Constructs manager and teammates
     * @param string $structure
     */
    public function __construct($structure)
    {
        $className = '\\level09\\Tools\\' . $structure;
        $this->hireAlchemist($className);
        $this->hireArchiver($className);
    }

    /**
     * Take source and target drivers and assign work to teammates
     * @param $source
     * @param $target
     */
    public function prepare($source, $target): void
    {
        $this->prepareAlchemist($source, $target);
        $this->prepareArchiver($source);
    }

    /**
     * Time to go to work
     */
    public function work(): void
    {
        if($this->levels)
            $this->loopThroughLevels();
        else
            $this->weHaveAQuotaToMeet();
    }

    /**
     * @param $className
     */
    public function hireAlchemist($className): void
    {
        $this->alchemist = new Alchemist();
        $this->alchemist->tool = $className;
    }

    /**
     * @param $className
     */
    public function hireArchiver($className): void
    {
        $this->archiver = new Archiver();
        $this->archiver->tool = $className;
    }

    /**
     * Set source and target for alchemy
     * @param $source
     * @param $target
     */
    public function prepareAlchemist($source, $target): void
    {
        $this->alchemist->source = $source;
        $this->alchemist->target = $target;
    }

    /**
     * Get archiver ready
     * @param $source string Driver
     */
    public function prepareArchiver($source): void
    {
        $this->archiver->source = $source;
    }

    /**
     * Set the levels to be processed
     * @param $levels
     */
    public function assignLevels($levels): void
    {
        $this->levels = $levels;
    }

    /**
     * Loop through selected levels, if we have any
     */
    private function loopThroughLevels()
    {
        foreach ($this->levels as $level) {
            $this->setLevel($level);
            $this->weHaveAQuotaToMeet();
        }
    }

    /**
     * Set current level to process
     */
    private function setLevel($level)
    {
        $this->archiver->level = $level;
        $this->alchemist->level = $level;
    }

    /**
     * Make teammates to their jobs
     */
    private function weHaveAQuotaToMeet()
    {
//        $this->archiver->work();
        $this->alchemist->work();
    }
}