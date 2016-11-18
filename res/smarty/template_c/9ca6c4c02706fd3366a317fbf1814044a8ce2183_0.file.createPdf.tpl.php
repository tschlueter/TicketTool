<?php
/* Smarty version 3.1.30, created on 2016-11-18 14:34:09
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\createPdf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f03515eea87_63176218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca6c4c02706fd3366a317fbf1814044a8ce2183' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\createPdf.tpl',
      1 => 1479474928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582f03515eea87_63176218 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

    <head>

        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>

        <meta charset="utf-8" />

        <link rel="icon"          href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

        <link rel="stylesheet" href="css/custom.css">

    </head>

    <body>

        This is the output field:

        <pre>
            <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        </pre>

    </body>

</html>
<?php }
}
