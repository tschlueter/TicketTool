<?php
/* Smarty version 3.1.30, created on 2016-11-18 14:51:55
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\createPdf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f077b128210_87644375',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca6c4c02706fd3366a317fbf1814044a8ce2183' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\createPdf.tpl',
      1 => 1479477016,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../component/head.tpl' => 1,
  ),
),false)) {
function content_582f077b128210_87644375 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<?php $_smarty_tpl->_subTemplateRender("file:../component/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <body>

        This is the output field:

        <pre>
            <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        </pre>

    </body>

</html>
<?php }
}
