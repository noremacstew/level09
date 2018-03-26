<?php

namespace level09\Lib\Datatypes\Matrix;

/**
 * Class Matrix31
 * Type-agnostic 3x1 bounded array
 * @package level09\Lib\DataFormatter
 */
class Matrix31
{
    protected $a, $b, $c;

    public function __debugInfo() {
        return $this->retrieve();
    }

    /**
     * Store 3x1 matrix
     * @param $array
     */
    public function __construct($array)
    {
        list($this->a, $this->b, $this->c) = $array;
    }

    /**
     * Retrieve 3x1 matrix
     * @return array
     */
    public function retrieve()
    {
        return array($this->a, $this->b, $this->c);
    }
}

/**
 * Class Matrix33
 * Type-agnostic 3x3 bounded array
 * @package level09\Lib\DataFormatter
 */
class Matrix33 extends Matrix31
{
    /** @var Matrix31 */
    protected $a, $b, $c;

    /**
     * Store a 3x3 matrix
     * @param $array
     */
    public function __construct($array)
    {
        $this->a = new Matrix31($array[0]);
        $this->b = new Matrix31($array[1]);
        $this->c = new Matrix31($array[2]);
    }

    /**
     * Retrieve 3x3 matrix
     * @return array
     */
    public function retrieve()
    {
        return array(
            $this->a->retrieve(),
            $this->b->retrieve(),
            $this->c->retrieve()
        );
    }
}

/**
 * Class Matrix41
 * Type-agnostic 4x1 bounded array
 * @package level09\Lib\DataFormatter
 */
class Matrix41
{
    protected $a, $b, $c, $d;

    public function __debugInfo() {
        return $this->retrieve();
    }

    /**
     * Store 4x1 matrix
     * @param $array
     */
    public function __construct($array)
    {
        list($this->a, $this->b, $this->c, $this->d) = $array;
    }

    /**
     * Retrieve 4x1 matrix
     * @return array
     */
    public function retrieve()
    {
        return array($this->a, $this->b, $this->c, $this->d);
    }
}

/**
 * Class Matrix43
 * Type-agnostic 4x3 bounded array
 * @package level09\Lib\DataFormatter
 */
class Matrix43 extends Matrix31
{
    /** @var Matrix41 */
    protected $a, $b, $c;

    /**
     * Store 4x3 matrix
     * @param $array
     */
    public function __construct($array)
    {
        $this->a = new Matrix41($array[0]);
        $this->b = new Matrix41($array[1]);
        $this->c = new Matrix41($array[2]);
    }

    /**
     * Retrieve 4x3 matrix
     * @return array
     */
    public function retrieve()
    {
        return array(
            $this->a->retrieve(),
            $this->b->retrieve(),
            $this->c->retrieve(),
        );
    }
}

/**
 * Class Matrix44
 * Type-agnostic 4x4 bounded array
 * @package level09\Lib\DataFormatter
 */
class Matrix44 extends Matrix41
{
    /** @var Matrix41 */
    protected $a, $b, $c, $d;

    /**
     * Store 4x4 matrix
     * @param $array
     */
    public function __construct($array)
    {
        $this->a = new Matrix41($array[0]);
        $this->b = new Matrix41($array[1]);
        $this->c = new Matrix41($array[2]);
        $this->d = new Matrix41($array[3]);
    }

    /**
     * Retrieve 4x4 matrix
     * @return array
     */
    public function retrieve()
    {
        return array(
            $this->a->retrieve(),
            $this->b->retrieve(),
            $this->c->retrieve(),
            $this->d->retrieve(),
        );
    }
}