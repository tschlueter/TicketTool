<?php
/**
 * Manages LaTeX generation.
 */
class Service_LatexCreator
{

    /**
     * Tests the functionality.
     */
    public static function test()
    {
        // include latex template

        $fileNameTexIn  = 'res/latex/latexTemplate.tex';
        $fileNameTexOut = Controller_Setting::PATH_OUT_TMP . 'latexTest.tex';

        $data = file_get_contents($fileNameTexIn);


        // create latex file

        file_put_contents($fileNameTexOut, $data);

        @unlink(Controller_Setting::PATH_OUT_TMP . 'latexTest.pdf');

        // render to pdf

        $command = 'pdflatex -output-directory=' . Controller_Setting::PATH_OUT_TMP . ' ' . $fileNameTexOut . ' ';
        $output = shell_exec($command);

        Controller_TicketTool::DEBUG_LOG(
            'Latex generation output is '
            . '<pre style="border: 1px solid #a0a0a0; background: #e0e0e0; color: #202020; padding: 10px;">'
            . $output
            . '</pre>'
        );
    }

}