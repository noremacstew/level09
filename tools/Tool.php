<?php

namespace level09\Tools;
use level09\Drivers\Driver;
use level09\Structures\Structure;

/**
 * Tools are responsible for translating data between any driver the internal structure. They should be capable of
 * extracting one or all objects, storing one or all objects, transmuting one or all objects
 * @package level09\Tools
 */
abstract class Tool
{
    /** @var  Driver */
    protected $source;
    /** @var  Driver */
    protected $target;
    /** @var  Structure */
    protected $data;
    /** @var  array */
    protected $level;
    /** @var  array */
    protected $supportedDrivers = array();
    /** @var string  */
    protected $journeyPath = '../Journey in progress/USRDIR'; // @todo with launch alias, this should be an empty string
    /** @var  string  */
    protected $filepath;

    /** public **/
    /**
     * Load driver class, or throw error
     * @param $driver
     * @throws \Exception
     */
    public function loadDriver($property, $driver)
    {
        $this->validateDriver($driver);
        $driverClass = preg_replace('/Tools/', 'Drivers', get_called_class());
        $driverClass = preg_replace('/Tool/', $driver . 'Driver', $driverClass);
        $this->$property = new $driverClass();
    }

    /**
     * Set the level to be worked on
     * @param $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Extract all items from source format and rebuild in target format
     */
    public function transmute(): void
    {
        $this->source->initRead($this->getFilepath(get_class($this->source)));
        $this->source->initWrite($this->getFilepath(get_class($this->target)));
        for($i = 0; $i < $this->source->getCount(); $i++)
            $this->transmuteOne();
    }

    /**
     * Extract all data from storage into structure
     * @return mixed
     */
    public function extract(): array
    {
        $extracted = array();
        $this->source->initRead($this->getFilepath(get_class($this->source)));
        for($i = 0; $i < $this->source->getCount(); $i++)
            $extracted[] = $this->extractOne();

        return $extracted;
    }

    /**
     * Build all internal structures into external storage
     * @return mixed
     */
    public function build($structures): void
    {
        $this->source->initWrite($this->getFilepath(get_class($this->target)));
        foreach ($structures as $structure)
            $this->buildOne($structure);
    }

    /**
     * Extract one item from source format and rebuild in target format
     */
    public function transmuteOne(): void
    {
        $this->buildOne($this->extractOne());
    }


    /** abstract **/
    /**
     * Extract one item from storage into structure
     * @return mixed
     */
    abstract public function extractOne(): Structure;

    /**
     * Build one internal structure into external storage
     * @return mixed
     */
    abstract public function buildOne($structure): void;


    /** protected **/
    /**
     * Throw an exception if the driver is not supported for this tool
     * @param $driver
     * @throws \Exception
     */
    protected function validateDriver($driver): void
    {
        if (! in_array( $driver, $this->supportedDrivers ) )
            throw new \Exception('Using ' . get_called_class() . " with $driver is not supported");
    }

    /**
     * Get path to
     * @return string
     */
    protected function getFilepath(string $driver)
    {
        return $this->journeyPath . $this->filepath;
    }
}