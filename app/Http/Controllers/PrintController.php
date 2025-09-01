<?php

namespace App\Http\Controllers;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //
    public function cetakStruk()
    {
        try {
            // ganti dengan nama printer yang muncul di Control Panel
            $connector = new WindowsPrintConnector("RONGTA 80mm Series Printer");
            $printer   = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("=== TOKO MAKMUR ===\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Barang A   Rp10.000\n");
            $printer->text("Barang B   Rp20.000\n");
            $printer->text("---------------------\n");
            $printer->text("Total      Rp30.000\n");

            $printer->feed(3);
            $printer->cut();
            $printer->close();

            return "Struk berhasil dicetak!";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
