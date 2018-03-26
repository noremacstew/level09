<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class MeshChamUvNormShader extends Shader
{
    protected $aoStepBiasInt;
    protected $chamColor;
    protected $chamEdgeColor;
    protected $chamIsAlphaTest;
    protected $chamLevel;
    protected $chamScale;
    protected $inShadow;
    protected $texAo;
    protected $texCham;
    protected $texChamMask;
    protected $texColor;
    protected $texDetail;
    protected $texEdgeMask;
    protected $texRamp;
    protected $uvMlt;
    protected $uvOffset;
}