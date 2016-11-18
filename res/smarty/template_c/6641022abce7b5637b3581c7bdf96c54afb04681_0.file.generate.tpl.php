<?php
/* Smarty version 3.1.30, created on 2016-11-18 16:40:03
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\generate.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582f20d37537e2_90335138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6641022abce7b5637b3581c7bdf96c54afb04681' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\generate.tpl',
      1 => 1479480934,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../component/head.tpl' => 1,
  ),
),false)) {
function content_582f20d37537e2_90335138 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<?php $_smarty_tpl->_subTemplateRender("file:../component/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <body>

        <pre>
            <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        </pre>

        <form target="_self" method="get" action="index.php" enctype="multipart/form-data">

            <input type="submit" value="Back to upload form">

        </form>

    </body>

</html>
<?php }
}
