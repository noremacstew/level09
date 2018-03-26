<?php

namespace level09\Tools;
use level09\Structures\DecorationMesh;
use level09\Structures\Structure;

class DecorationMeshTool extends Tool
{
    protected $supportedDrivers = array(
        'Binary',
        'Json',
//        'Mysql',
    );
    protected $filepath = '/Data/Scripts/LEVEL/DecorationMeshInstancesEXT';

    /**
     * @return DecorationMesh
     */
    public function extractOne(): Structure
    {
        return $this->source->readObject();
    }

    /**
     * @param $structure
     */
    public function buildOne($structure): void
    {
//        var_dump($structure);
//        die('build one');
//        $this->target->setFloat(        $structure->levelMagic);
//        $this->target->setMatrix44(     $structure->transformation, 'float');
//        $this->target->setInt(          $structure->brightness);
//        $this->target->setInt(          $structure->saturation);
//        $this->target->setMatrix31(     $structure->hue, 'float');
//        $this->target->setFloat(        $structure->shaderLODMin);
//        $this->target->setFloat(        $structure->shaderLODMax);
//        $this->target->setFloat(        $structure->fadeMin);
//        $this->target->setFloat(        $structure->fadeMax);
//        $this->target->setString(       $structure->shader);
//        $this->target->setShaderParams( $structure->shaderParams);
//        $this->target->setInt(          $structure->renderMode);
//        $this->target->setInt(          count($structure->shaderParams));
        $this->target->writeObject($structure);
    }

    /**
     * Get path to file
     * @param string $driver
     * @return string
     */
    protected function getFilepath(string $driver)
    {
        if ( stristr( $driver, 'Binary' ) )    $ext = '.lua.bin';
        else if ( stristr( $driver, 'Json' ) ) $ext = '.json';
        else $ext = '';

        $filepath = str_replace('LEVEL', $this->level, $this->filepath);
        $filepath = str_replace('EXT', $ext, $filepath);

        return $this->journeyPath . $filepath;
    }
}