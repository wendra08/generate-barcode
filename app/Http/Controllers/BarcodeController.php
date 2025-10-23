<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\DNS2D;

class BarcodeController extends Controller
{
    public function index()
    {
        $barcodes = Barcode::orderBy('created_at', 'desc')->paginate(20);
        return view('barcodes.index', compact('barcodes'));
    }

    public function create()
    {
        return view('barcodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:barcodes,code|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Barcode::create($request->all());

        return redirect()->route('barcodes.index')
            ->with('success', 'Barcode berhasil ditambahkan');
    }

    public function edit(Barcode $barcode)
    {
        return view('barcodes.edit', compact('barcode'));
    }

    public function update(Request $request, Barcode $barcode)
    {
        $request->validate([
            'code' => 'required|unique:barcodes,code,' . $barcode->id . '|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $barcode->update($request->all());

        return redirect()->route('barcodes.index')
            ->with('success', 'Barcode berhasil diupdate');
    }

    public function destroy(Barcode $barcode)
    {
        $barcode->delete();

        return redirect()->route('barcodes.index')
            ->with('success', 'Barcode berhasil dihapus');
    }

    public function generatePDF(Request $request)
    {
        $barcodeIds = $request->input('barcode_ids', []);

        // Handle if it comes as JSON string
        if (is_string($barcodeIds) && !empty($barcodeIds)) {
            $decoded = json_decode($barcodeIds, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $barcodeIds = $decoded;
            } else {
                $barcodeIds = explode(',', $barcodeIds);
            }
        }

        if (empty($barcodeIds)) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada barcode yang dipilih.']);
        }

        $barcodes = Barcode::whereIn('id', $barcodeIds)->get();

        if ($barcodes->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Barcode tidak ditemukan.']);
        }

        // Convert logos to base64
        $kementerianLogo = null;
        $svlkLogo = null;

        // Try different image formats for Kementerian logo
        $kementerianPaths = [
            public_path('images/kementerian_logo.png'),
            public_path('images/kementerian_logo.jpg'),
            public_path('images/logo_kementerian.png'),
            public_path('images/tree_logo.png'),
        ];

        foreach ($kementerianPaths as $path) {
            if (file_exists($path)) {
                $kementerianLogo = base64_encode(file_get_contents($path));
                break;
            }
        }

        // Try different image formats for SVLK logo
        $svlkPaths = [
            public_path('images/svlk_logo.png'),
            public_path('images/svlk_logo.jpg'),
            public_path('images/svlk.png'),
        ];

        foreach ($svlkPaths as $path) {
            if (file_exists($path)) {
                $svlkLogo = base64_encode(file_get_contents($path));
                break;
            }
        }

        // Generate QR codes as PNG (better compatibility with DomPDF)
        $dns2d = new DNS2D();

        $barcodeData = $barcodes->map(function ($b) use ($dns2d, $kementerianLogo, $svlkLogo) {
            // Generate QR Code as PNG instead of SVG
            $qrPng = $dns2d->getBarcodePNG($b->code, 'QRCODE', 8, 8);

            return [
                'code' => $b->code,
                'description' => $b->description,
                'qr_image' => $qrPng,
                'kementerian_logo' => $kementerianLogo,
                'svlk_logo' => $svlkLogo
            ];
        });

        $pdf = Pdf::loadView('barcodes.pdf', compact('barcodeData'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('barcodes_' . now()->format('Ymd_His') . '.pdf');
    }
}
