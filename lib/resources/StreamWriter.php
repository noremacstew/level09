<?php

namespace level09\Lib\Resources;
//use level09\Lib\Datatypes\Matrix\Matrix43;
//use level09\Lib\Datatypes\Matrix\Matrix44;

/**
 * Trait StreamWriter
 * @todo split this into smaller traits
 * @package level09\Lib
 */
trait StreamWriter
{
    protected $stream;
    protected $bigEndianMode = true;

    abstract public function __construct($settings);
    abstract public function seek($offset): int;
    abstract public function seekCur($offset): int;

    /**
     * @todo this may not need #ofbytes anymore
     * @param $data
     * @param $bytes
     * @param null $format
     * @return mixed
     */
    abstract public function write($data, $bytes, $format=null);
    abstract public function position(): int;

    /* convenience functions */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Sets endianness for reading
     * @param $bigEndianMode
     */
    public function setBigEndian($bigEndianMode)
    {
        $this->bigEndianMode = $bigEndianMode;
    }

    /**
     * Returns if we are in big endian mode
     * @param $bigEndianMode
     */
    public function bigEndianMode()
    {
        return $this->bigEndianMode;
    }

    /*--     BINARY     --*/
    public function bin8($data)
    {
        return $this->write($data,1);
    }
    public function bin16($data)
    {
        return $this->write($data, 2);
    }
    public function bin32($data)
    {
        return $this->write($data, 4);
    }

    /*--   HEX STRINGS  --*/
    public function hex8($data)
    {
        return $this->write($data, 1, 'H');
    }
    public function hex16($data)
    {
        return $this->write($data, 2, 'H*');
    }
    public function hex32($data)
    {
        $format = $this->bigEndianMode ? 'H*' : 'h*';
        return $this->write($data, 4, $format);
    }

    /*--   SIGNED INT   --*/
    public function int8($data)
    {
        return $this->write($data, 1, 'c');
    }
    public function int16($data)
    {
        return $this->write($data, 2, 's');
    }
    public function int32($data)
    {
        return $this->write($data, 4, 'i');
    }
    public function int64($data)
    {
        return $this->write($data, 8, 'q');
    }

    /*--  UNSIGNED INT  --*/
    public function uint8($data)
    {
        return $this->write($data, 1, 'C');
    }
    public function uint16($data)
    {
        $format = $this->bigEndianMode ? 'n' : 'v';
        return $this->write($data, 2, $format);
    }
    public function uint32($data)
    {
        $format = $this->bigEndianMode ? 'N' : 'V';
        return $this->write($data, 4, $format);
    }

    /*--     FLOATS     --*/
    /* @todo endian-ness */
    /* @todo reverse this process */
//    public function float16($data)
//    {
//        $float = $this->uint16();
//        $sign     = ($float & 0b1000000000000000) >> 15;
//        $exponent = ($float & 0b0111110000000000) >> 10;
//        $mantissa = ($float & 0b0000001111111111);
//
//        $exponentValue = $exponent ? pow(2, $exponent-15) : 0;
//        $mantissaValue = 1;
//
//        foreach (range(0, 9) as $shift) {
//            $mask = 2^$shift;
//            $factor = 2^-(10-$shift);
//            $mantissaValue += (($mantissa & $mask) >> $shift) * $factor;
//        }
//
//        $halfValue = $mantissaValue * $exponentValue;
//        if($sign)
//            $halfValue *= -1;
//
//        return $halfValue;
//    }
    public function float32($data)
    {
        $format = $this->bigEndianMode ? 'G' : 'g';
        return $this->write($data, 4, $format);
    }

    /*--     STRINGS     --*/
    public function uint8PrefixedLengthString($data)
    {
        return $this->fixedLengthString($data, $this->uint8($data));
    }
    public function uint16PrefixedLengthString($data)
    {
        return $this->fixedLengthString($data, $this->uint16($data));
    }
    public function uint32PrefixedLengthString($data)
    {
        return $this->fixedLengthString($data, $this->uint32($data));
    }
    public function fixedLengthString($data, $length)
    {
        return fwrite($this->stream, $data, $length);
    }
    public function string($data)
    {
        return $this->fixedLengthString($data, strlen($data));
    }
    /* @todo change to str2hex ? */
    public function hex2str($hex)
    {
        $str = '';
        for ($i = 0; $i < strlen($hex); $i += 2)
            $str .= chr(hexdec(substr($hex, $i, 2)));

        return $str;
    }

    /*-- Vectors enforce column count --*/
    /*--     Vector2     --*/
//    public function vec2i8($data)
//    {
//        return $this->vec2($data, 'int8');
//    }
//    public function vec2i16($data)
//    {
//        return $this->vec2($data, 'int16');
//    }
//    public function vec2i32($data)
//    {
//        return $this->vec2($data, 'int32');
//    }
//    public function vec2u8($data)
//    {
//        return $this->vec2($data, 'uint8');
//    }
//    public function vec2u16($data)
//    {
//        return $this->vec2($data, 'uint16');
//    }
//    public function vec2u32($data)
//    {
//        return $this->vec2($data, 'uint32');
//    }
//    public function vec2f16($data)
//    {
//        return $this->vec2($data, 'float16');
//    }
//    public function vec2f32($data)
//    {
//        return $this->vec2($data, 'float32');
//    }

    /*--     Vector3     --*/
//    public function vec3i8($data)
//    {
//        return $this->vec3($data, 'int8');
//    }
//    public function vec3i16($data)
//    {
//        return $this->vec3($data, 'int16');
//    }
//    public function vec3i32($data)
//    {
//        return $this->vec3($data, 'int32');
//    }
//    public function vec3u8($data)
//    {
//        return $this->vec3($data, 'uint8');
//    }
//    public function vec3u16($data)
//    {
//        return $this->vec3($data, 'uint16');
//    }
//    public function vec3u32($data)
//    {
//        return $this->vec3($data, 'uint32');
//    }
//    public function vec3f16($data)
//    {
//        return $this->vec3($data, 'float16');
//    }
//    public function vec3f32($data)
//    {
//        return $this->vec3($data, 'float32');
//    }

    /*--     Vector4     --*/
//    public function vec4i8($data)
//    {
//        return $this->vec4($data, 'int8');
//    }
//    public function vec4i16($data)
//    {
//        return $this->vec4($data, 'int16');
//    }
//    public function vec4i32($data)
//    {
//        return $this->vec4($data, 'int32');
//    }
//    public function vec4u8($data)
//    {
//        return $this->vec4($data, 'uint8');
//    }
//    public function vec4u16($data)
//    {
//        return $this->vec4($data, 'uint16');
//    }
//    public function vec4u32($data)
//    {
//        return $this->vec4($data, 'uint32');
//    }
//    public function vec4f16($data)
//    {
//        return $this->vec4($data, 'float16');
//    }
//    public function vec4f32($data)
//    {
//        return $this->vec4($data, 'float32');
//    }

    /*-- Matrices enforce row and column count --*/
    /*--     Matrix      --*/
//    public function matrix43f32()
//    {
//        return new Matrix43($this->vec4f32(), $this->vec4f32(), $this->vec4f32());
//    }
//    public function matrix44f32()
//    {
//        return new Matrix44($this->vec4f32(), $this->vec4f32(), $this->vec4f32(), $this->vec4f32());
//    }

    /*-- Arrays are lists, no enforcement --*/
    /*--     Arrays      --*/
//    public function int8Array($size)
//    {
//        return $this->vecn($size, 'int8');
//    }
//    public function int16Array($size)
//    {
//        return $this->vecn($size, 'int16');
//    }
//    public function int32Array($size)
//    {
//        return $this->vecn($size, 'int32');
//    }
//    public function uint8Array($size)
//    {
//        return $this->vecn($size, 'uint8');
//    }
//    public function uint16Array($size)
//    {
//        return $this->vecn($size, 'uint16');
//    }
//    public function uint32Array($size)
//    {
//        return $this->vecn($size, 'uint32');
//    }
//    public function float16Array($size)
//    {
//        return $this->vecn($size, 'float16');
//    }
//    public function float32Array($size)
//    {
//        return $this->vecn($size, 'float32');
//    }

//    public function vec2i8Array($size)
//    {
//        return $this->vecn($size, 'vec2i8');
//    }
//    public function vec2i16Array($size)
//    {
//        return $this->vecn($size, 'vec2i16');
//    }
//    public function vec2i32Array($size)
//    {
//        return $this->vecn($size, 'vec2i32');
//    }
//    public function vec2u8Array($size)
//    {
//        return $this->vecn($size, 'vec2u8');
//    }
//    public function vec2u16Array($size)
//    {
//        return $this->vecn($size, 'vec2u16');
//    }
//    public function vec2u32Array($size)
//    {
//        return $this->vecn($size, 'vec2u32');
//    }
//    public function vec2f16Array($size)
//    {
//        return $this->vecn($size, 'vec2f16');
//    }
//    public function vec2f32Array($size)
//    {
//        return $this->vecn($size, 'vec2f32');
//    }

//    public function vec3i8Array($size)
//    {
//        return $this->vecn($size, 'vec3i8');
//    }
//    public function vec3i16Array($size)
//    {
//        return $this->vecn($size, 'vec3i16');
//    }
//    public function vec3i32Array($size)
//    {
//        return $this->vecn($size, 'vec3i32');
//    }
//    public function vec3u8Array($size)
//    {
//        return $this->vecn($size, 'vec3u8');
//    }
//    public function vec3u16Array($size)
//    {
//        return $this->vecn($size, 'vec3u16');
//    }
//    public function vec3u32Array($size)
//    {
//        return $this->vecn($size, 'vec3u32');
//    }
//    public function vec3f16Array($size)
//    {
//        return $this->vecn($size, 'vec3f16');
//    }
//    public function vec3f32Array($size)
//    {
//        return $this->vecn($size, 'vec3f32');
//    }

//    public function vec4i8Array($size)
//    {
//        return $this->vecn($size, 'vec4i8');
//    }
//    public function vec4i16Array($size)
//    {
//        return $this->vecn($size, 'vec4i16');
//    }
//    public function vec4i32Array($size)
//    {
//        return $this->vecn($size, 'vec4i32');
//    }
//    public function vec4u8Array($size)
//    {
//        return $this->vecn($size, 'vec4u8');
//    }
//    public function vec4u16Array($size)
//    {
//        return $this->vecn($size, 'vec4u16');
//    }
//    public function vec4u32Array($size)
//    {
//        return $this->vecn($size, 'vec4u32');
//    }
//    public function vec4f16Array($size)
//    {
//        return $this->vecn($size, 'vec4f16');
//    }
//    public function vec4f32Array($size)
//    {
//        return $this->vecn($size, 'vec4f32');
//    }

//    public function matrix43f32Array($size)
//    {
//        return $this->vecn($size, 'matrix43f32');
//    }
//    public function matrix44f32Array($size)
//    {
//        return $this->vecn($size, 'matrix44f32');
//    }

    /*--   Quaternions   --*/
//    public function quat16()
//    {
//        return new Quat($this->float16(), $this->float16(), $this->float16(), $this->float16());
//    }
//    public function quat32()
//    {
//        return new Quat($this->float32(), $this->float32(), $this->float32(), $this->float32());
//    }

    /*-- protected --*/
//    protected function vecn($size, $callback)
//    {
//        $vec = array();
//        foreach (range(0, $size-1) as $i)
//            $vec[$i] = $this->$callback();
//
//        return $vec;
//    }
//    protected function vec2($callback)
//    {
//        return array($this->$callback(), $this->$callback(), 0);
//    }
//    protected function vec3($callback)
//    {
//        return $this->vecn(3, $callback);
//    }
//    protected function vec4($callback)
//    {
//        return $this->vecn(4, $callback);
//    }
}