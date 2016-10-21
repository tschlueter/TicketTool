<?php

require_once( 'src/TicketTool.php' );
require_once( 'src/JiraTicketImporter.php' );
require_once( 'src/PdfExporter.php' );

require_once( 'src/model/JiraTicket.php' );

require_once( 'src/service/Curl.php' );

TicketTool::main();
