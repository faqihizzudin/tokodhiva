<?php
require __DIR__ . '/../third_party/Mike42/autoloader.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

try {
		// Enter the device file for your USB printer here
	  $connector = new Escpos\PrintConnectors\FilePrintConnector("EPSON TM-U220 Receipt");
		   
		/* Print a "Hello world" receipt" */
		$printer = new Escpos\Printer($connector);
		$printer -> text("Hello World!\n");
		$printer -> cut();

		/* Close printer */
		$printer -> close();
} catch (Exception $e) {
	echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
?>