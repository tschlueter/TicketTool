<!DOCTYPE html>
<html>

{include file='../component/head.tpl'}

    <body>

        <div class="container-table wow zoomIn" data-wow-delay="0.0s" data-wow-duration="2.5s">
            <div class="container-cell">

                <div class="container container-main" style="visibility: hidden;">

                    <img id="logo" src="res/image/logo.png" alt="BAHAG TicketTool" title="BAHAG TicketTool">
                    <pre>{$asciiLogo}</pre>

                    <div class="container wow fadeIn" data-wow-delay="1.0s" data-wow-duration="0.5s">

                        <pre id="outputConsole">{$consoleOutput}</pre>

                        <form target="_self" method="get" action="index.php" enctype="multipart/form-data">

                            <input type="submit" value="Back">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>
