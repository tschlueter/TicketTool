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
        // create latex file

        $fileNameTex = 'out/latexTest.tx';
        $data = (
            '\documentclass{article}' . "\n"
            . '\begin{document}'      . "\n"
            . '    Hello World!'      . "\n"
            . '\end{document}'        . "\n"
        );

        file_put_contents($fileNameTex, $data);

        // render to pdf

        $command = 'pdflatex -output-directory=out ' . $fileNameTex . ' ';
        $output = shell_exec($command);
    }

}