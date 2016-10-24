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

        $fileNameTexIn  = 'in/latexTemplate.tex';
        $fileNameTexOut = 'out/tmp/latexTest.tex';

        $data = file_get_contents($fileNameTexIn);


        // create latex file

        file_put_contents($fileNameTexOut, $data);

        @unlink('out/tmp/latexTest.pdf');

        // render to pdf

        $command = 'pdflatex -output-directory=out/tmp ' . $fileNameTexOut . ' ';
        $output = shell_exec($command);

        echo 'Latex generation output is <pre style="border: 1px solid #a0a0a0; background: #e0e0e0; color: #202020; padding: 10px;">' . $output . '</pre><br><br><hr><br>';
    }

}