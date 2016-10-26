<?php
/* Smarty version 3.1.30, created on 2016-10-26 13:58:26
  from "C:\Users\Stock\workspaces\www-local\TicketTool\template\default\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58109a624f0f86_49549501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aee94ab200594e8b121dcf7e84e7d78bc6fcb3f7' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\template\\default\\index.tpl',
      1 => 1477483104,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58109a624f0f86_49549501 (Smarty_Internal_Template $_smarty_tpl) {
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
