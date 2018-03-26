<?php

namespace stew\Lib\Resources\StreamReader;
use level09\Lib\Resources\StreamReader;

/**
 * Class FileStreamReader
 * Simplifies binary file parsing
 */
class FileResourceReader
{
    use StreamReader;
//    private $m_StreamLength;
//    private $m_DisableRangeCheck;

    /**
     * These methods are identical to FileStreamWriters; consider composition
     */
    public function __construct($filePath)
    {
        $this->stream = fopen($filePath, "r");
    }
    public function __destruct()
    {
        fclose($this->stream);
    }
    public function position(): int
    {
        return ftell($this->stream);
    }
    public function seek($offset): int
    {
        return fseek($this->stream, $offset);
    }
    public function seekCur($offset): int
    {
        return fseek($this->stream, $offset, SEEK_CUR);
    }

    /**
     * Read $length bytes from file, and optionally unpack() them into $format
     *
     * @param $format
     * @param $length
     * @return mixed
     */
    public function read($length, $format=null)
    {
        if (! $format)
            return fread($this->stream, $length);

        return current(unpack($format, fread($this->stream, $length)));
    }
}
