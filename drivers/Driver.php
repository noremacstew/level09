<?php

namespace level09\Drivers;
use level09\Structures\Structure;

/**
 * Interface Driver
 * Responsible for translating between an arbitrary structure and a file format
 * @package level09\Drivers
 */
interface Driver
{
    public function initRead($settings): void;
    public function initWrite($settings): void;
    public function readObject(): Structure;
    public function writeObject(Structure $structure);
    public function postRead(): void;
    public function postWrite(): void;
    public function getCount(): int;
}