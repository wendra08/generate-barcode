<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarcodeController;

Route::get('/', function () {
    return redirect('/barcodes');
});

// CRUD Routes
Route::get('/barcodes', [BarcodeController::class, 'index'])->name('barcodes.index');
Route::get('/barcodes/create', [BarcodeController::class, 'create'])->name('barcodes.create');
Route::post('/barcodes', [BarcodeController::class, 'store'])->name('barcodes.store');
Route::get('/barcodes/{barcode}/edit', [BarcodeController::class, 'edit'])->name('barcodes.edit');
Route::put('/barcodes/{barcode}', [BarcodeController::class, 'update'])->name('barcodes.update');
Route::delete('/barcodes/{barcode}', [BarcodeController::class, 'destroy'])->name('barcodes.destroy');

Route::post('/barcodes/pdf/generate', [BarcodeController::class, 'generatePDF'])->name('barcodes.generate-pdf');


// // Generate PDF Route - URL BARU
// Route::post('/generate-barcodes-pdf', [BarcodeController::class, 'generatePdf'])
//     ->name('barcodes.generate-pdf');
