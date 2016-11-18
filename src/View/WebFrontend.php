<?php
/**
 * Handles all components for the Web frontend.
 */
class View_WebFrontend
{

    /**
     * @var Smarty
     */
    private $_smarty = null;

    /**
     * Initialize the smarty engine.
     */
    public function __construct()
    {
        $this->_smarty = new Smarty();

        $this->_smarty->setTemplateDir('res/smarty/template'  );
        $this->_smarty->setCompileDir( 'res/smarty/template_c');

        $this->_smarty->assign(
            'pageTitle',
            Controller_Setting::TITLE
            . ', WEB-edition, v.'
            . Controller_Setting::VERSION
        );
    }

    /**
     * Shows the upload web form.
     */
    public function showUploadForm()
    {
        $asciiLogo = Controller_TicketTool::getAsciiLogo();
        $asciiLogo .= '<br>';
        $asciiLogo .= Controller_Setting::TITLE . ', WEB-edition, v.' . Controller_Setting::VERSION;

        $this->_smarty->assign('asciiLogo', $asciiLogo);

        $this->_smarty->assign('formActionGenerateFromTicketIds', Controller_Setting::ACTION_ID_CREATE_PDF_FROM_TICKET_IDS);
        $this->_smarty->assign('formActionGenerateFromXml',       Controller_Setting::ACTION_ID_CREATE_PDF_FROM_XML);

        $this->_smarty->display('default/upload.tpl');
    }

    /**
     * Shows the upload web form.
     *
     * @param string $output
     */
    public function showGenerationPage($output)
    {
        $this->_smarty->assign('output',    $output);

        $this->_smarty->display('default/generate.tpl');
    }

}