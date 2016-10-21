<?php
/**
 * Offers PSR-0 autoloading.
 */
class Autoloader
{

    /**
     * Sets up autoloading.
     */
    public static function init()
    {
        spl_autoload_register('Autoloader::autoload');
    }

    /**
     * The autoload function that handles access to dynamically invoked classes.
     *
     * @param string $className The name of the class to autoload.
     */
    private static function autoload($className)
    {
        echo 'Test [' . $className . ']<br>';

        $className = ltrim($className, '\\');
        $fileName  = 'src' . DIRECTORY_SEPARATOR;

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        echo 'FileName [' . $fileName . ']<br>';

        require_once($fileName);
    }

}