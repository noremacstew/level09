<?php

namespace stew\Lib\Resources\StreamWriter;
use level09\Lib\Resources\StreamWriter;

/**
 * Class FileStreamReader
 * Simplifies binary file parsing
 */
class FileResourceWriter
{
    use StreamWriter;

    /**
     * These methods are identical to FileStreamReaders; consider composition
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
     * Write $length bytes to file, optionally pack() into $format
     * @param $data
     * @param $format
     * @param $length
     * @return mixed
     */
    public function write($data, $length, $format=null)
    {
        if (! $format)
            return fread($this->stream, $length);

        return current(unpack($format, fread($this->stream, $length)));
    }
}
