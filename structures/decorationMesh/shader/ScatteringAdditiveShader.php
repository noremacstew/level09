<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class ScatteringAdditiveShader extends Shader
{
    protected $alpha;
    protected $alphaFade;
    protected $mltColor;
    protected $scatter;
    protected $tex;
    protected $uvOffset;
}