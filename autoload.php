<?php
namespace level09;

/**
 * Forgive the 'clever' code. This autoloads class files if needed,
 * assuming the namespaced classname matches the directory path
 * directories are forced to lower case, filename is left intact
 */
spl_autoload_register(function ($className) {
    var_dump($className);
    foreach ($path = array_slice(explode('\\', $className),1) as $i => $dir)
        if($i != count($path)-1) $path[$i] = lcfirst($dir);

    $file = implode('/', $path) . '.php';
    var_dump("AUTO: " . $file);
    include_once $file;
});

class Autoloader
{
    private $structure;

    function __construct()
    {
        // load libraries
        $this->requireAll("lib");
    }

    function loadStructures($structure)
    {
        $this->handlePath("structures/$structure");
        $this->handlePath("structures/$structure.php");
        $this->handlePath("tools/${structure}Tool.php");
        $this->handlePath("workers");
        $this->structure = $structure;
    }

    function loadDrivers($import, $export)
    {
//        $this->handlePath("drivers/Driver.php");
        $this->loadDriver($import);
        if($import != $export)
            $this->loadDriver($export);
    }

    /** private **/
    /**
     * Recursively require all files in a directory.
     * You probably should only use this for the Lib files
     * This is probably susceptible to recursive symlinks
     * @param $folder
     */
    private function requireAll($folder)
    {
        $scan = glob("$folder/*");
        foreach ($scan as $path)
            $this->handlePath($path);
    }

    /**
     * Check if a given path is to a php file, a directory, or something else
     * include_once php files, requireAll files in directory, ignore others
     * @param $path
     */
    private function handlePath($path)
    {
        if (preg_match('/\.php$/', $path)) {
//            var_dump("LOAD: " . $path);
            include_once $path;
        } elseif (is_dir($path)) {
            $this->requireAll($path);
        }
    }

    private function loadDriver($driver)
    {
        $this->handlePath("drivers/${driver}Driver.php");
        $this->handlePath('drivers/' . $this->structure . $driver . 'Driver.php');
    }
}