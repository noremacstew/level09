<?php

namespace level09\Drivers;
use level09\Structures\Structure;
use stew\Lib\Resources\StreamReader\FileResourceReader;
use stew\Lib\Resources\StreamWriter\FileResourceWriter;

abstract class BinaryDriver implements Driver
{
    /** @var  FileResourceReader */
    protected $reader;
    /** @var  FileResourceWriter */
    protected $writer;
    /** @var  Structure */
    protected $instance;
    /** @var  int */
    protected $count;


    public function initRead($settings): void {}
    public function initWrite($settings): void {}
    public function readObject(): Structure {}
    public function writeObject(Structure $structure) {}
    public function postRead(): void {}
    public function postWrite(): void {}
    public function getCount(): int {}

}