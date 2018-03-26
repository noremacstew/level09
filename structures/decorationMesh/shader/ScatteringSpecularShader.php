<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class ScatteringSpecularShader extends Shader
{
    protected $alpha;
    protected $alphaFade;
    protected $fresnelColor;
    protected $fresnelFalloff;
    protected $mltColor;
    protected $scatter;
    protected $tex;
    protected $uvOffset;
}