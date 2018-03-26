<?php

namespace level09\Tools;

use level09\Structures\Hull;
use level09\Structures\Structure;

class HullTool extends Tool
{
    protected $supportedDrivers = array(
        'Binary',
        'JSON',
        'Mel',
//        'MySQL',
    );
    protected $filename = 'HullInstances.lua.bin';

    public function transmute(): void
    {

    }

    public function extract(): array
    {

    }

    public function build($structures): void
    {

    }

    public function transmuteOne(): void
    {

    }

    public function extractOne(): Structure
    {

    }

    public function buildOne($structure): void
    {

    }
}