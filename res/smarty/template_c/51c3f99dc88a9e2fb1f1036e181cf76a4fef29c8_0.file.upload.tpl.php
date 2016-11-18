<?php
/* Smarty version 3.1.30, created on 2016-11-18 17:19:29
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\upload.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f2a11a4ab73_39708627',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51c3f99dc88a9e2fb1f1036e181cf76a4fef29c8' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\upload.tpl',
      1 => 1479485967,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../component/head.tpl' => 1,
  ),
),false)) {
function content_582f2a11a4ab73_39708627 (Smarty_Internal_Template $_smarty_tpl) {
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

                <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                    <label class="formLabel">Ticket-IDs:<br><br></label>
                    <input id="ticketIds" type="text" name="ticketIds" title="Ticket-IDs"><br><br>
                    <input type="submit" value="PDF aus Ticket-IDs generieren">

                    <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['formActionGenerateFromTicketIds']->value;?>
">

                </form>

            </div>

            <br>

            <div class="container">

                <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                    <label class="formLabel">XML file:<br><br></label>
                    <input id="xmlFile" type="file" name="xmlFile" title="XML file upload"><br><br>
                    <input type="submit" value="PDF aus XML generieren">

                    <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['formActionGenerateFromXml']->value;?>
">

                </form>

            </div>

        </div>

    </body>

</html>
<?php }
}
