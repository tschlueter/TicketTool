<?php
/* Smarty version 3.1.30, created on 2016-11-04 10:09:11
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_581c50377f5684_56595776',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '739ca697c6807ef90223acc90b808fbd38dc9fa2' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\index.tpl',
      1 => 1477483104,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581c50377f5684_56595776 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
    <head>
        <title>Info</title>
    </head>
    <body>

        <pre>
            User Information:

            Name: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

            Address: <?php echo $_smarty_tpl->tpl_vars['address']->value;?>

        </pre>

    </body>
</html>
<?php }
}
