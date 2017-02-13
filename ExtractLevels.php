<?php
// config variables
// what levels will we extract?
$levels = array(
  'Barrens', 'Bryan', 'Canyon', 'Cave',
  'Chris', 'Credits', 'Desert', 'Graveyard',
  'Matt', 'Mountain', 'Ruins', 'Summit'
);

// state variables
$directory = '';
$hash = '';
$class = '';
$object = '';
$counter = 0;
$set = 0;

/**
 * Loop through each level's DecorationMeshInstances to process, and manage state between files
 */
function loopThroughLevels() {
    global $levels, $directory, $counter, $set;

    foreach($levels as $level) {
        $counter = $set = 0;
        $directory = "Level_$level";

        handleFile();
    }
}

/**
 * Open the level's DecorationMeshInstances file and process it
 */
function handleFile() {
    global $directory;

    $readfile = fopen("$directory/DecorationMeshInstances.lua.bin", "r");

    if($readfile)
        processFile($readfile);

    fclose($readfile);
}

/**
 * Read the file and extract objects
 *
 * @param $readfile
 */
function processFile($readfile) {
    //throw away the first line
    $line = bin2hex(fread($readfile, 16));

    while(!feof($readfile)) {
        $line = bin2hex(fread($readfile, 16));
        extractObject($line);
    }
}

/**
 * Save the line to the global object. Also saves the hash and class for later use.
 *
 * @param $line
 * @return int
 */
function extractObject($line) {
    global $counter, $object;

    extractHash($line);
    extractClass($line);
    $object .= $line;

    //we're at the end of the block
    if(($counter+1)%132 == 0)
        writeFile();

    $counter++;
}

/**
 * Extract the hash from the DecorationMeshInstance
 *
 * @param $line
 */
function extractHash($line) {
    global $counter, $hash;

    if($counter == 7 || $counter == 8)
        $hash .= $line;
}

/**
 * Extract the class name from the DecorationMeshInstance
 *
 * @param $line
 */
function extractClass($line) {
    global $counter, $class;

    if($counter == 11 || $counter == 12)
        $class .= $line;
}

/**
 * Write the object to a file
 */
function writeFile() {
    global $directory, $hash, $class, $object;

    $object = hex2bin($object);
    $class = hex2str(trim($class, '0'));
    $hash = hex2str($hash);
    $path = prepareOutput();

    echo "Extracting $directory/$class/$hash\n";
    file_put_contents($path, $object);
    resetState();
}

/**
 * Prepare the output file path, and return it
 * We also
 * @return string
 */
function prepareOutput() {
    global $hash, $class, $directory;

    $classSubdir = "$directory/DecorationMeshInstances/$class";
    if(!realpath($classSubdir))
        mkdir(realpath("./") . '/' . $classSubdir, 0777, TRUE);

    $path = realpath($classSubdir) . "/$hash";

    return $path;
}

/**
 * Translate hex code into ascii
 * @param $hex
 * @return string
 */
function hex2str($hex) {
    $str = '';

    //get 2-byte chunks, encode decimal, then get ascii
    for($i=0;$i<strlen($hex);$i+=2)
        $str .= chr(hexdec(substr($hex,$i,2)));

    return $str;
}

function resetState() {
    global $hash, $class, $object, $counter, $set;

    $hash = $class = $object = '';
    $counter = -1;
    $set++;
}



loopThroughLevels();