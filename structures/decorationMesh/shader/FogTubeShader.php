<?php

namespace level09\Structures\DecorationMesh\Shader;
use level09\Structures\DecorationMesh\Shader;

class FogTubeShader extends Shader
{
    protected $alpha;
    protected $alphaFade;
    protected $depthExtra;
    protected $farCutoff;
    protected $farFadeDist;
    protected $mltColor;
    protected $nearCutoff;
    protected $nearFadeDist;
    protected $scatter;
    protected $softFadeoutRate;
    protected $tex;
    protected $uvOffset;
}