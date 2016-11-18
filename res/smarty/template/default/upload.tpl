<!DOCTYPE html>
<html>

{include file='../component/head.tpl'}

    <body>

        <div id="mainContainer" class="container">

            <img id="logo" src="res/image/logo.png" alt="BAHAG TicketTool" title="BAHAG TicketTool">
            <pre>{$asciiLogo}</pre>

            <div class="container">

                <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                    <label class="formLabel">Ticket-IDs:<br><br></label>
                    <input id="ticketIds" type="text" name="ticketIds" title="Ticket-IDs"><br><br>
                    <input type="submit" value="PDF aus Ticket-IDs generieren">

                    <input type="hidden" name="action" value="{$formActionGenerateFromTicketIds}">

                </form>

            </div>

            <br>

            <div class="container">

                <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                    <label class="formLabel">XML file:<br><br></label>
                    <input id="xmlFile" type="file" name="xmlFile" title="XML file upload"><br><br>
                    <input type="submit" value="PDF aus XML generieren">

                    <input type="hidden" name="action" value="{$formActionGenerateFromXml}">

                </form>

            </div>

        </div>

    </body>

</html>
