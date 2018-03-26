<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class MeshBillboardShader extends Shader
{
    protected $aoStepBiasInt;
    protected $inShadow;
    protected $texAo;
    protected $texColor;
    protected $texDetail;
    protected $texEdgeMask;
    protected $texRamp;
    protected $uvMlt;
}