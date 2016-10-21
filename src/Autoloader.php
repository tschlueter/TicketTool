<?php
/**
 * Offers simple PSR-0 autoloading.
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

        $fileName = (
                'src'
            .   DIRECTORY_SEPARATOR
            .   str_replace('_', DIRECTORY_SEPARATOR, $className)
            .   '.php'
        );

        echo 'FileName [' . $fileName . ']<br><br>';

        require_once($fileName);
    }

}