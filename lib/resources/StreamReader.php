<?php

namespace level09\Lib\Resources;
use level09\Lib\Datatypes\Matrix\Matrix43;
use level09\Lib\Datatypes\Matrix\Matrix44;

/**
 * Trait StreamReader
 * @todo split this into smaller traits
 * @package level09\Lib
 */
trait StreamReader
{
    protected $stream;
    protected $bigEndianMode = true;

    abstract public function __construct($settings);
    abstract public function seek($offset): int;
    abstract public function seekCur($offset): int;
    abstract public function read($bytes, $format=null);
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
    public function bin8()
    {
        return $this->read( 1 );
    }
    public function bin16()
    {
        return $this->read( 2 );
    }
    public function bin32()
    {
        return $this->read( 4 );
    }
    public function bin($n)
    {
        return $this->read( $n / 8 );
    }

    /*--   HEX STRINGS  --*/
    public function hex8()
    {
        return $this->read( 1,      'H' );
    }
    public function hex16()
    {
        return $this->read( 2,      'H*' );
    }
    public function hex32()
    {
        return $this->read( 4,      $this->bigEndianMode ? 'H*' : 'h*' );
    }
    public function hex($n)
    {
        return $this->read( $n / 8, $this->bigEndianMode ? 'H*' : 'h*' );
    }

    /*--   SIGNED INT   --*/
    public function int8()
    {
        return $this->read( 1,      'c' );
    }
    public function int16()
    {
        return $this->read( 2,      's' );
    }
    public function int32()
    {
        return $this->read( 4,      'i' );
    }
    public function int64()
    {
        return $this->read( 8,      'q' );
    }

    /*--  UNSIGNED INT  --*/
    public function uint8()
    {
        return $this->read( 1,      'C' );
    }
    public function uint16()
    {
        return $this->read( 2,      $this->bigEndianMode ? 'n' : 'v' );
    }
    public function uint32()
    {
        return $this->read( 4,      $this->bigEndianMode ? 'N' : 'V' );
    }

    /*--     FLOATS     --*/
    /* @todo endian-ness */
    public function float16()
    {
        $float = $this->uint16();
        $sign     = ($float & 0b1000000000000000) >> 15;
        $exponent = ($float & 0b0111110000000000) >> 10;
        $mantissa = ($float & 0b0000001111111111);

        $exponentValue = $exponent ? pow(2, $exponent-15) : 0;
        $mantissaValue = 1;

        foreach (range(0, 9) as $shift) {
            $mask = 2^$shift;
            $factor = 2^-(10-$shift);
            $mantissaValue += (($mantissa & $mask) >> $shift) * $factor;
        }

        $halfValue = $mantissaValue * $exponentValue;
        if($sign)
            $halfValue *= -1;

        return $halfValue;
    }
    public function float32()
    {
        return $this->read( 4,      $this->bigEndianMode ? 'G' : 'g' );
    }

    /*--     STRINGS     --*/
    public function uint8PrefixedLengthString()
    {
        return $this->fixedLengthString($this->uint8());
    }
    public function uint16PrefixedLengthString()
    {
        return $this->fixedLengthString($this->uint16());
    }
    public function uint32PrefixedLengthString()
    {
        return $this->fixedLengthString($this->uint32());
    }
    public function fixedLengthString($length)
    {
        return fread($this->stream, $length);
    }
    public function paddedString($size)
    {
        $end = $this->position() + $size;
        $str = $this->string();
        $this->seek($end);

        return $str;
    }
    public function string()
    {
        $str = "";
        $chr = $this->char();
        while( $chr != "\0") {
            $str .= $chr;
            $chr = $this->char();
        }

        return $str;
    }
    public function stringPtr()
    {
        $ptr = $this->uint32();
        $position = $this->position();
        $str = null;

        if ( $ptr ) {
            $this->seek($ptr);
            $str = $this->string();
            $this->seek($position);
        }

        return $str;
    }
    public function char()
    {
        return chr($this->uint8());
    }
    public function hex2str($hex)
    {
        $str = '';
        for ($i = 0; $i < strlen($hex); $i += 2)
            $str .= chr(hexdec(substr($hex, $i, 2)));

        return $str;
    }

    /*-- Vectors enforce column count --*/
    /*--     Vector2     --*/
    public function vec2i8()
    {
        return $this->vec2('int8');
    }
    public function vec2i16()
    {
        return $this->vec2('int16');
    }
    public function vec2i32()
    {
        return $this->vec2('int32');
    }
    public function vec2u8()
    {
        return $this->vec2('uint8');
    }
    public function vec2u16()
    {
        return $this->vec2('uint16');
    }
    public function vec2u32()
    {
        return $this->vec2('uint32');
    }
    public function vec2f16()
    {
        return $this->vec2('float16');
    }
    public function vec2f32()
    {
        return $this->vec2('float32');
    }

    /*--     Vector3     --*/
    public function vec3i8()
    {
        return $this->vec3('int8');
    }
    public function vec3i16()
    {
        return $this->vec3('int16');
    }
    public function vec3i32()
    {
        return $this->vec3('int32');
    }
    public function vec3u8()
    {
        return $this->vec3('uint8');
    }
    public function vec3u16()
    {
        return $this->vec3('uint16');
    }
    public function vec3u32()
    {
        return $this->vec3('uint32');
    }
    public function vec3f16()
    {
        return $this->vec3('float16');
    }
    public function vec3f32()
    {
        return $this->vec3('float32');
    }

    /*--     Vector4     --*/
    public function vec4i8()
    {
        return $this->vec4('int8');
    }
    public function vec4i16()
    {
        return $this->vec4('int16');
    }
    public function vec4i32()
    {
        return $this->vec4('int32');
    }
    public function vec4u8()
    {
        return $this->vec4('uint8');
    }
    public function vec4u16()
    {
        return $this->vec4('uint16');
    }
    public function vec4u32()
    {
        return $this->vec4('uint32');
    }
    public function vec4f16()
    {
        return $this->vec4('float16');
    }
    public function vec4f32()
    {
        return $this->vec4('float32');
    }

    /*-- Matrices enforce row and column count --*/
    /*--     Matrix      --*/
    public function matrix43f32()
    {
        return new Matrix43(array($this->vec4f32(), $this->vec4f32(), $this->vec4f32()));
    }
    public function matrix44f32()
    {
        return new Matrix44(array($this->vec4f32(), $this->vec4f32(), $this->vec4f32(), $this->vec4f32()));
    }


    /*-- Arrays are lists, no enforcement --*/
    /*--     Arrays      --*/
    public function int8Array($size)
    {
        return $this->vecn($size, 'int8');
    }
    public function int16Array($size)
    {
        return $this->vecn($size, 'int16');
    }
    public function int32Array($size)
    {
        return $this->vecn($size, 'int32');
    }
    public function uint8Array($size)
    {
        return $this->vecn($size, 'uint8');
    }
    public function uint16Array($size)
    {
        return $this->vecn($size, 'uint16');
    }
    public function uint32Array($size)
    {
        return $this->vecn($size, 'uint32');
    }
    public function float16Array($size)
    {
        return $this->vecn($size, 'float16');
    }
    public function float32Array($size)
    {
        return $this->vecn($size, 'float32');
    }

    public function vec2i8Array($size)
    {
        return $this->vecn($size, 'vec2i8');
    }
    public function vec2i16Array($size)
    {
        return $this->vecn($size, 'vec2i16');
    }
    public function vec2i32Array($size)
    {
        return $this->vecn($size, 'vec2i32');
    }
    public function vec2u8Array($size)
    {
        return $this->vecn($size, 'vec2u8');
    }
    public function vec2u16Array($size)
    {
        return $this->vecn($size, 'vec2u16');
    }
    public function vec2u32Array($size)
    {
        return $this->vecn($size, 'vec2u32');
    }
    public function vec2f16Array($size)
    {
        return $this->vecn($size, 'vec2f16');
    }
    public function vec2f32Array($size)
    {
        return $this->vecn($size, 'vec2f32');
    }

    public function vec3i8Array($size)
    {
        return $this->vecn($size, 'vec3i8');
    }
    public function vec3i16Array($size)
    {
        return $this->vecn($size, 'vec3i16');
    }
    public function vec3i32Array($size)
    {
        return $this->vecn($size, 'vec3i32');
    }
    public function vec3u8Array($size)
    {
        return $this->vecn($size, 'vec3u8');
    }
    public function vec3u16Array($size)
    {
        return $this->vecn($size, 'vec3u16');
    }
    public function vec3u32Array($size)
    {
        return $this->vecn($size, 'vec3u32');
    }
    public function vec3f16Array($size)
    {
        return $this->vecn($size, 'vec3f16');
    }
    public function vec3f32Array($size)
    {
        return $this->vecn($size, 'vec3f32');
    }

    public function vec4i8Array($size)
    {
        return $this->vecn($size, 'vec4i8');
    }
    public function vec4i16Array($size)
    {
        return $this->vecn($size, 'vec4i16');
    }
    public function vec4i32Array($size)
    {
        return $this->vecn($size, 'vec4i32');
    }
    public function vec4u8Array($size)
    {
        return $this->vecn($size, 'vec4u8');
    }
    public function vec4u16Array($size)
    {
        return $this->vecn($size, 'vec4u16');
    }
    public function vec4u32Array($size)
    {
        return $this->vecn($size, 'vec4u32');
    }
    public function vec4f16Array($size)
    {
        return $this->vecn($size, 'vec4f16');
    }
    public function vec4f32Array($size)
    {
        return $this->vecn($size, 'vec4f32');
    }

    public function matrix43f32Array($size)
    {
        return $this->vecn($size, 'matrix43f32');
    }
    public function matrix44f32Array($size)
    {
        return $this->vecn($size, 'matrix44f32');
    }

    /*--   Quaternions   --*/
    public function quat16()
    {
        return new Quat($this->float16(), $this->float16(), $this->float16(), $this->float16());
    }
    public function quat32()
    {
        return new Quat($this->float32(), $this->float32(), $this->float32(), $this->float32());
    }

    /*-- protected --*/
    protected function vecn($size, $callback)
    {
        $vec = array();
        foreach (range(0, $size-1) as $i)
            $vec[$i] = $this->$callback();

        return $vec;
    }
    protected function vec2($callback)
    {
        return array($this->$callback(), $this->$callback(), 0);
    }
    protected function vec3($callback)
    {
        return $this->vecn(3, $callback);
    }
    protected function vec4($callback)
    {
        return $this->vecn(4, $callback);
    }
}