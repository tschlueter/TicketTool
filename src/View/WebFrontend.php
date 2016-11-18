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
     *
     * @param string $output
     */
    public function showUploadForm($output)
    {
        $this->_smarty->assign('output', $output);

        $this->_smarty->display('default/uploadForm.tpl');
    }

}