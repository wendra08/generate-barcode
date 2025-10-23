<?php

namespace Database\Seeders;

use App\Models\Barcode;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
{
    public function run()
    {
        $barcodes = [
            ['code' => '1234567890', 'description' => 'Produk Elektronik - Laptop'],
            ['code' => '5544332211', 'description' => 'Produk Minuman - Kopi Sachet'],
            ['code' => '9988776655', 'description' => 'Produk Kesehatan - Vitamin C'],
            ['code' => '5566778899', 'description' => 'Produk Buku - Novel Fiksi'],
            ['code' => '1357924680', 'description' => 'Produk Olahraga - Sepatu Lari'],
            ['code' => '2468013579', 'description' => 'Produk Kosmetik - Lipstik'],
            ];
foreach ($barcodes as $barcode) {
        Barcode::create($barcode);
    }
}
}
