<?php
/* Smarty version 3.1.30, created on 2016-11-18 14:09:57
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\uploadForm.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582efda560f6c3_46089820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d59b370e2ea9fbed22f740a96a1e71e99bc5070' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\uploadForm.tpl',
      1 => 1479474593,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582efda560f6c3_46089820 (Smarty_Internal_Template $_smarty_tpl) {
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

        <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

            <label>Ticket-IDs:</label>
            <input type="text" name="ticketIds" title="Ticket-IDs">

            <label>XML file:</label>
            <input type="file" name="xmlFile" title="XML file upload">

        </form>

        This is the output field:

        <pre>
            <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        </pre>

    </body>

</html>
<?php }
}
