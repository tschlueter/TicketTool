<!DOCTYPE html>
<html>

{include file='../component/head.tpl'}

    <body>

        <div class="container-table wow zoomIn" data-wow-delay="0.0s" data-wow-duration="2.0s">
            <div class="container-cell">

                <div class="container container-main" style="visibility: hidden;">

                    <img id="logo" src="res/image/logo.png" alt="BAHAG TicketTool" title="BAHAG TicketTool">
                    <pre>{$asciiLogo}</pre>

                    <div class="container wow fadeIn" data-wow-delay="0.5s" data-wow-duration="0.5s">

                        <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                            <label class="formLabel">Ticket-IDs:<br><br></label>
                            <input id="ticketIds" type="text" name="ticketIds" title="Ticket-IDs"><br><br>
                            <input type="submit" value="Generate">

                            <input type="hidden" name="action" value="{$formActionGenerateFromTicketIds}">

                        </form>

                    </div>

                    <br>

                    <div class="container wow fadeIn" data-wow-delay="1.0s" data-wow-duration="0.5s">

                        <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                            <label class="formLabel">XML file:<br><br></label>
                            <input id="xmlFile" type="file" name="xmlFile" title="XML file upload"><br><br>
                            <input type="submit" value="Generate">

                            <input type="hidden" name="action" value="{$formActionGenerateFromXml}">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>
