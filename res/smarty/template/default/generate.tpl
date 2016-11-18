<!DOCTYPE html>
<html>

{include file='../component/head.tpl'}

    <body>

        <div id="mainContainer" class="container">

            <img id="logo" src="res/image/logo.png" alt="BAHAG TicketTool" title="BAHAG TicketTool">
            <pre>{$asciiLogo}</pre>

            <div class="container">

                <pre id="outputConsole">{$consoleOutput}</pre>

                <form target="_self" method="get" action="index.php" enctype="multipart/form-data">

                    <input type="submit" value="Back to upload form">

                </form>

            </div>

        </div>

    </body>

</html>
