<?php

require_once('lib/php/fpdf-1.81/fpdf.php');
require_once('lib/php/phpqrcode-1.1.4/phpqrcode.php');
require_once('lib/php/smarty-3.1.30/Smarty.class.php');

require_once( 'src/Autoloader.php' );

Autoloader::init();

$ticketToolController = new Controller_TicketTool();
$ticketToolController->run();
