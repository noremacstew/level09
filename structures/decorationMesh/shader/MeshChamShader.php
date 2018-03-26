<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class MeshChamShader extends Shader
{
    protected $aoStepBiasInt;
    protected $chamColor;
    protected $chamDir;
    protected $chamEdgeColor;
    protected $chamLevel;
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