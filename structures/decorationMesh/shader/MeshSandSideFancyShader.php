<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class MeshSandSideFancyShader extends Shader
{
    protected $aoStepBiasInt;
    protected $duneHeightOff;
    protected $inShadow;
    protected $texAo;
    protected $texColor;
    protected $texDetail;
    protected $texEdgeMask;
    protected $texRamp;
    protected $uvMlt;
    protected $uvOffset;
}