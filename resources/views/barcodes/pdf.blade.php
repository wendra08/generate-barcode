<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barcode Document - A5</title>
    <style>
        @page {
            size: A5 portrait;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            background: white;
            margin: 0;
            padding: 0;
        }

        .barcode-card {
            width: 148mm;      /* A5 width */
            height: 210mm;     /* A5 height */
            display: flex;
            align-items: center;
            justify-content: center;
            page-break-after: always;
        }

        .box {
            border: 1.5px solid #000;
            width: 135mm;
            height: 185mm;
            padding: 15mm 10mm;
            position: relative;
        }

        /* Logo Kementerian kiri atas */
        .logo-kementerian {
            position: absolute;
            top: 12mm;
            left: 15mm;
            width: 22mm;
            height: auto;
        }

        /* Header */
        .header-section {
            text-align: center;
            margin-top: 10mm;
            font-weight: bold;
            line-height: 1.3;
        }

        .header-section .title {
            font-size: 13pt;
        }

        /* Nama perusahaan */
        .company-name {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            margin-top: 8mm;
        }

        /* QR Codes */
        .qr-codes-section {
            text-align: center;
            margin-top: 8mm;
        }

        .qr-code {
            display: inline-block;
            margin: 0 4mm;
        }

        .qr-code img {
            width: 30mm;
            height: 30mm;
        }

        /* Nomor Barcode */
        .barcode-number {
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 11pt;
            letter-spacing: 0.5px;
            margin-top: 6mm;
        }

        /* Footer - Logo SVLK */
        .footer-section {
            text-align: center;
            margin-top: 8mm;
        }

        .svlk-logo {
            width: 28mm;
            height: auto;
            margin-bottom: 3mm;
        }

        .license-number {
            font-size: 10pt;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
    <div class="barcode-card">
        <div class="box">
            <!-- Logo Kementerian -->
            <img src="data:image/png;base64,{{ $barcode['kementerian_logo'] }}" alt="Logo Kementerian" class="logo-kementerian">

            <!-- Header -->
            <div class="header-section">
                <div class="title">
                    KEMENTERIAN KEHUTANAN<br>
                    REPUBLIK INDONESIA
                </div>
            </div>

            <!-- Nama Perusahaan -->
            <div class="company-name">
                PT. ITCI KARTIKA UTAMA
            </div>

            <!-- QR Codes -->
            <div class="qr-codes-section">
                <div class="qr-code"><img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR"></div>
                <div class="qr-code"><img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR"></div>
                <div class="qr-code"><img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR"></div>
            </div>

            <!-- Nomor Barcode -->
            <div class="barcode-number">
                {{ $barcode['code'] }}
            </div>

            <!-- Footer -->
            <div class="footer-section">
                <img src="data:image/png;base64,{{ $barcode['svlk_logo'] }}" alt="SVLK Logo" class="svlk-logo">
                <div class="license-number">PHL-64-01-0068</div>
            </div>
        </div>
    </div>
</body>
</html>
