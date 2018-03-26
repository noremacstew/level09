<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class ScatteringSoftShader extends Shader
{
    protected $alpha;
    protected $alphaFade;
    protected $depthExtra;
    protected $mltColor;
    protected $scatter;
    protected $softFadeoutRate;
    protected $tex;
    protected $uvOffset;
}