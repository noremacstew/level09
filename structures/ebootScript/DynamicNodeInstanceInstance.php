<?php

namespace level09\Structures\EbootScript;
use level09\Structures\EbootScript;

class DynamicNode extends EbootScript
{
    /** @var  string ? */
    protected $type;
    /** @var  string ? */
    protected $shortcut;
    /** @var  DynamicNodeVars */
    protected $vars;
//    protected $validVars = array(   //
//        'vars' => array(
//            'bankMult',
//            'clothMeshes',
//            'segments',
//            'target',
//            'generateAABB',
//            'clientSimulate',
//            'animationTarget',
//            'attachSegRelativePos',
//            'attachSegRelativeRot',
//            'attachSegRot',
//            'gardenerName'
//        )
//    );
}