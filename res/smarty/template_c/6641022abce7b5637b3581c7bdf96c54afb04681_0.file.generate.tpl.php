<?php
/* Smarty version 3.1.30, created on 2016-11-18 18:22:22
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\generate.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f38ce714b30_29839144',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6641022abce7b5637b3581c7bdf96c54afb04681' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\generate.tpl',
      1 => 1479489737,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../component/head.tpl' => 1,
  ),
),false)) {
function content_582f38ce714b30_29839144 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<?php $_smarty_tpl->_subTemplateRender("file:../component/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <body>

        <div id="mainContainer" class="container">

            <img id="logo" src="res/image/logo.png" alt="BAHAG TicketTool" title="BAHAG TicketTool">
            <pre><?php echo $_smarty_tpl->tpl_vars['asciiLogo']->value;?>
</pre>

            <div class="container">

                <pre id="outputConsole"><?php echo $_smarty_tpl->tpl_vars['consoleOutput']->value;?>
</pre>

                <form target="_self" method="get" action="index.php" enctype="multipart/form-data">

                    <input type="submit" value="Back">

                </form>

            </div>

        </div>

    </body>

</html>
<?php }
}
