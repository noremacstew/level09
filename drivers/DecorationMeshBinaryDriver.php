<?php

namespace level09\Drivers;
use level09\Structures\DecorationMesh;
use level09\Structures\Structure;
use stew\Lib\Resources\StreamReader\FileResourceReader;
use stew\Lib\Resources\StreamWriter\FileResourceWriter;

class DecorationMeshBinaryDriver extends BinaryDriver
{
    /** @var  DecorationMesh */
    protected $instance;

    public function initRead($filepath): void
    {
        $this->reader = new FileResourceReader($filepath);
        $this->reader->uint32();                                //first uint is always 00000001
        $this->count = $this->reader->uint32();
        $this->reader->read(8);                             // zeros
    }

    public function initWrite($filepath): void
    {
        $this->writer = new FileResourceWriter($filepath);
        $this->writer->uint32(1);                         //first uint is always 00000001
        $this->writer->uint32($this->count);
    }

    public function readObject(): Structure
    {
        $this->instance                 = new DecorationMesh();
        $this->instance->levelMagic     = $this->reader->hex32();
                                          $this->reader->read(12);      // zeros
        $this->instance->transformation = $this->reader->matrix44f32();
        $this->instance->shaderLODMin   = $this->reader->float32();
        $this->instance->shaderLODMax   = $this->reader->float32();
        $this->instance->fadeMin        = $this->reader->float32();
        $this->instance->fadeMax        = $this->reader->float32();
        $this->instance->brightness     = $this->reader->float32(); //?
        $this->instance->saturation     = $this->reader->float32(); //?
        $this->instance->hue            = $this->reader->float32(); //?
        $this->instance->renderMode     = $this->reader->uint32();
        $this->instance->name           = $this->reader->fixedLengthString(32);
                                          $this->reader->read(32);      // zeros
        $this->instance->texture        = $this->reader->paddedString(64);
        $this->instance->shader         = $this->reader->paddedString(64);
        $this->instance->initShader();
        $this->loadShaderData();

        return $this->instance;
    }

    public function writeObject(Structure $structure): void
    {
        var_dump("write object");
    }

    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Load all shader properties
     */
    private function loadShaderData()
    {
        $cur = $this->reader->position();
        $this->reader->seekCur(1792);
        $propCount = $this->reader->uint32();

        $this->reader->seek($cur);
        for( $i = 0; $i < $propCount; $i++ )
            $this->loadShaderProp();

        $this->reader->seek($cur + 1808);
    }

    /**
     * Load one shader property
     */
    private function loadShaderProp()
    {
        $cur = $this->reader->position();
        $this->reader->seek($cur + 80);
        $property = $this->reader->paddedString(16);
        $flag = $this->reader->uint32();

        $this->reader->seek($cur);
        $this->instance->setShaderParam($property, $this->getShaderPropValue($flag));
        $this->reader->seek($cur + 112);
    }

    /**
     * Get property value from reader, based on flag
     * @param $flag
     * @return array|string
     * @throws \Exception
     */
    private function getShaderPropValue($flag)
    {
        $value = $this->reader->vec4f32();

        if ( $flag === 2 )
            $value = $this->reader->paddedString(64);
        else
            $value[3] = $flag;

        return $value;
    }
}