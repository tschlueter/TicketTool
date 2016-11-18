<?php
/* Smarty version 3.1.30, created on 2016-11-18 10:29:00
  from "C:\Users\Stock\workspaces\www-local\TicketTool\res\smarty\template\default\uploadForm.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582ec9dc96be25_51704134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d59b370e2ea9fbed22f740a96a1e71e99bc5070' => 
    array (
      0 => 'C:\\Users\\Stock\\workspaces\\www-local\\TicketTool\\res\\smarty\\template\\default\\uploadForm.tpl',
      1 => 1479461335,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_582ec9dc96be25_51704134 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

    <head>

        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>

        <meta charset="utf-8" />

        <link rel="icon"          href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

        <?php echo '<script'; ?>
 src="lib/js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="lib/js/jquery.ui.widget.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="lib/js/jquery.iframe-transport.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="lib/js/jquery.fileupload.js"><?php echo '</script'; ?>
>

    </head>

    <body>

        <pre>
            <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        </pre>



<!--
        <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
-->
        <?php echo '<script'; ?>
>
return;
alert("Test 1");

        $(
            function ()
            {
alert("Test 2");

                $('#fileupload').fileupload(
                    {
                        dataType: 'json',
                        done: function (e, data) {
                            $.each(
                                data.result.files,
                                function (index, file) {

alert("Test 3");


                                    $('<p/>').text(file.name).appendTo(document.body);


                                }
                            );
                        }
                    }
                );
            }
        );
        <?php echo '</script'; ?>
>




    </body>

</html>
<?php }
}
