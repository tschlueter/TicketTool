<?php

require_once( 'lib/fpdf/fpdf.php' );
require_once( 'lib/qr/phpqrcode.php' );
require_once( 'src/Autoloader.php' );

Autoloader::init();
Controller_TicketTool::main();
