<?php

/**
 * General Notes
 *
 * need to get a working export from decomesh file into json
 * need to get a working export from json into decomesh
 *
 *
 * to do:
 *  1.  need to re-implement the big endian switches
 *  2.  possibly need to re-implement bound checks, since there are speculative reads
 *
 */

namespace level09;
use level09\Lib\CLIManager;
use level09\Workers\Manager;

@include 'autoload.php';
$autoload = new Autoloader();

// run command line prompts
$cli = new CLIManager();
$cli->promptStructure();
$cli->promptSource();
$cli->promptDestination();
$cli->promptAdditional();

// load structure and drivers
$autoload->loadStructures($cli->getStructure());
$autoload->loadDrivers($cli->getSourceDriver(), $cli->getDestinationDriver());


// prepare workers
$manager = new Manager($cli->getStructure());
$manager->prepare($cli->getSourceDriver(), $cli->getDestinationDriver());
$manager->assignLevels($cli->getLevels());

// work
$manager->work();


echo "all done\n";


/*
 * Architecture notes
 * mostly to keep my head straight about the whys
 * stars denote assets created with dynamic class names

manager
   |
|----|
|   alchemist
archiver


archiver
     |
  |-----|
  |    config           *   (used to instantiate target driver)
 tool                   *
  |
|-----|
|    source driver      *
target driver           *   (hardcoded archive)


alchemist
   |
  tool                  *
   |
|-----|
|    source driver      *
target driver           *


source driver
   |
|-----|
|    resource reader    *   (Mysql, Binary, Json, etc)
structure               *   (DecorationMesh, EbootScript, Hull, etc)


target driver
   |
|-----|
|    resource writer    *   (Mysql, Binary, Json, etc)
structure               *   (DecorationMesh, EbootScript, Hull, etc)



 */