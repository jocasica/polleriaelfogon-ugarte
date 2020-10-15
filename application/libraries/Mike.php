<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once 'Mike/autoload.php';

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

class Mike
{
	public function imprimirTicket()
	{
	    $conector = new FilePrintConnector("php://stdout");
	    $logo = EscposImage::load("resources/escpos-php.png", false);
        $printer = new Printer($connector);
        /* Print top logo */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> graphics($logo);
        /* Name of shop */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text("ExampleMart Ltd.\n");
        $printer -> selectPrintMode();
        $printer -> text("Shop No. 42.\n");
        $printer -> feed();
        /* Title of receipt */
        $printer -> setEmphasis(true);
        $printer -> text("SALES INVOICE\n");
        $printer -> setEmphasis(false);
        /* Items */
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> setEmphasis(true);
        $printer -> setEmphasis(false);
        
        $printer -> setEmphasis(true);
        $printer -> text($subtotal);
        $printer -> setEmphasis(false);
        $printer -> feed();
        /* Tax and total */
        $printer -> text($tax);
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text($total);
        $printer -> selectPrintMode();
        /* Footer */
        $printer -> feed(2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("Thank you for shopping at ExampleMart\n");
        $printer -> text("For trading hours, please visit example.com\n");
        $printer -> feed(2);
        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();
        $printer -> close();
	}
}

?>