<!DOCTYPE html>
<html>

{include file='../component/head.tpl'}

    <body>

        <img id="logo" src="res/image/logo.jpg" alt="BAHAG TicketTool" title="BAHAG TicketTool">

        <div class="formContainer">

            <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                <label>Ticket-IDs:</label>
                <input type="text" name="ticketIds" title="Ticket-IDs">
                <input type="submit" value="PDF aus Ticket-IDs generieren">

                <input type="hidden" name="action" value="{$formActionGenerateFromTicketIds}">

            </form>

        </div>

        <div class="formContainer">

            <form target="_self" method="post" action="index.php" enctype="multipart/form-data">

                <label>XML file:</label>
                <input type="file" name="xmlFile" title="XML file upload">
                <input type="submit" value="PDF aus XML generieren">

                <input type="hidden" name="action" value="{$formActionGenerateFromXml}">

            </form>

        </div>

    </body>

</html>
