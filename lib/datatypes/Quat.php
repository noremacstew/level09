<?php

namespace level09\Lib\Datatypes\Quat;

/**
 * Class Quat
 * For now I just need to store quaternion terms. This may expand into math methods if needed.
 * @todo add quat math functions to class
 * @package stew\Lib
 * @see http://help.autodesk.com/view/3DSMAX/2015/ENU/?guid=__files_GUID_C42F8CCE_CE31_49B4_9D5A_65C07D9F33FD_htm
 */
class Quat
{
    private $x, $y, $z, $w;

    function __construct($x, $y, $z, $w)
    {
        $this->x = $x;
        $this->y = $y;
        $this->w = $w;
        $this->z = $z;
    }

    function retrieve()
    {
        return array($this->w, $this->x, $this->y, $this->z);
    }
}