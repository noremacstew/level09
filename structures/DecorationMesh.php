<?php

namespace level09\Structures;
use level09\Lib\Datatypes\Matrix\Matrix31;
use level09\Lib\Datatypes\Matrix\Matrix44;
use level09\Structures\DecorationMesh\Shader;

class DecorationMesh extends Structure
{
    /** @var  int   different for each level; doesn't break if changed */
    public $levelMagic;
    /** @var  Matrix44 */
    public $transformation;
    /** @var  float */
    public $shaderLODMin;
    /** @var  float */
    public $shaderLODMax;
    /** @var  float */
    public $fadeMin;
    /** @var  float */
    public $fadeMax;
    /** @var  int */
    public $brightness;
    /** @var  int */
    public $saturation;
    /** @var  Matrix31 */
    public $hue;
    /** @var  int */
    public $renderMode;
    /** @var  string */
    public $name;
    /** @var  string */
    public $texture;
    /** @var  string */
    public $shader;
    /** @var  Shader */
    public $shaderParams;
    /** @var  array */
    private $modeMap = array(
        "Solid",                        //default mode
		"Dither",
		"Decal",
		"Alpha",
		"Alpha Low Res",
		"Additive",
		"Additive Low Res",
		"Soft",
		"Fog",
		"Hidden"
    );

    /**
     * Check if the set mode is valid
     * @return bool
     */
    public function isValidRenderMode()
    {
        return $this->renderMode and in_array($this->renderMode, $this->modeMap);
    }

    /**
     * Get Blend value
     * @return string
     */
    public function getRenderMode()
    {
        $mode = $this->isValidRenderMode() ? $this->modeMap[$this->renderMode] : 'Solid';
        return "DecorationBlend_" . str_replace(' ', '',$mode);
    }

    public function initShader()
    {
        $shaderClass = get_called_class() . '\\Shader\\' . $this->shader . 'Shader';
        $this->shaderParams = new $shaderClass();
    }

    /**
     * Set a shader param
     * @param $paramType
     * @param $values
     */
    public function setShaderParam($paramType, $values)
    {
        $this->shaderParams->$paramType = $values;
    }
}