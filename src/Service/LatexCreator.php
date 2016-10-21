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
        // include latex template

        $fileNameTexIn  = 'in/latexTemplate.tx';
        $fileNameTexOut = 'out/latexTest.tx';

        $data = file_get_contents($fileNameTexIn);


        // create latex file

        file_put_contents($fileNameTexOut, $data);

        @unlink('out/latexTest.pdf');

        // render to pdf

        $command = 'pdflatex -output-directory=out ' . $fileNameTexOut . ' ';
        $output = shell_exec($command);

        echo 'Latex generation output is <pre>' . $output . ']</pre><br><br><hr><br>';
    }

}