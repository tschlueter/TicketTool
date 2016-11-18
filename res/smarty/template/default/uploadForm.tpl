<!DOCTYPE html>
<html>

    <head>

        <title>{$pageTitle}</title>

        <meta charset="utf-8" />

        <link rel="icon"          href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

        <script src="lib/js/jquery-1.9.1.min.js"></script>
        <script src="lib/js/jquery.ui.widget.js"></script>
        <script src="lib/js/jquery.iframe-transport.js"></script>
        <script src="lib/js/jquery.fileupload.js"></script>

    </head>

    <body>

        <pre>
            {$output}
        </pre>



<!--
        <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
-->
        <script>
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
        </script>




    </body>

</html>
