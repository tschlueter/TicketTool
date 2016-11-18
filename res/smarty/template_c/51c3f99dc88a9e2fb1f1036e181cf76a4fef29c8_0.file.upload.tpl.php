<?php
/* Smarty version 3.1.30, created on 2016-11-18 14:49:22
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\upload.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f06e2714da5_90563949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51c3f99dc88a9e2fb1f1036e181cf76a4fef29c8' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\upload.tpl',
      1 => 1479476954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../component/head.tpl' => 1,
  ),
),false)) {
function content_582f06e2714da5_90563949 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<?php $_smarty_tpl->_subTemplateRender("file:../component/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <body>

        <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

            <label>Ticket-IDs:</label>
            <input type="text" name="ticketIds" title="Ticket-IDs">
            <input type="submit" value="PDF aus Ticket-IDs generieren">

            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['formActionGenerateFromTicketIds']->value;?>
">

        </form>

        <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

            <label>XML file:</label>
            <input type="file" name="xmlFile" title="XML file upload">
            <input type="submit" value="PDF aus XML generieren">

            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['formActionGenerateFromXml']->value;?>
">

        </form>

    </body>

</html>
<?php }
}
