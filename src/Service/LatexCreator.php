<?php
/**
 * Manages CURL calls.
 */
class Service_LatexCreator
{

    /**
     * Tests the functionality.
     */
    public static function test()
    {
        $fileName = 'out/latextTest.tx';
        $data = (
            '\documentclass{article}'   . "\n"
            . '\begin{document}'            . "\n"
            . '    Hello World!'                . "\n"
            . '\end{document}'              . "\n"
        );

        file_put_contents($fileName, $data);
    }

}