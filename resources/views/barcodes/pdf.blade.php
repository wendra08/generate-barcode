<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barcode Document</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            width: 100%;
            height: 100vh;
            display: table;
            padding: 30px;
        }

        .vertical-center {
            display: table-cell;
            vertical-align: middle;
        }

        .box {
            border: 2px solid #000;
            padding: 30px 40px;
            margin: 0 auto;
            width: 650px;
            min-height: 500px;
        }

        /* Top section with logo and header */
        .top-section {
            margin-bottom: 40px;
            overflow: hidden;
        }

        /* Logo Kementerian di kiri atas */
        .top-logo {
            float: left;
            width: 120px;
            height: auto;
            margin-right: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            padding-top: 20px;
        }

        .header h2 {
            margin: 2px 0;
            font-size: 30px;
            font-weight: bold;
            letter-spacing: 0.8px;
        }

        .title h3 {
            margin: 10px 0 0 0;
            font-size: 30px;
            font-weight: bold;
            letter-spacing: 0.8px;
            text-align: center;
        }

        /* QR Codes Section */
        .qr-section {
            text-align: center;
            margin: 50px 0 30px 0;
            clear: both;
        }

        .qr-container {
            display: inline-block;
            margin: 0 10px;
            vertical-align: middle;
        }

        .qr-container img {
            width: 210px;
            height: 190px;
        }

        .qr-container:nth-child(2) img {
            width: 150px;
            height: 150px;
        }

        /* Barcode Code Text */
        .barcode-code {
            font-size: 26px;
            font-weight: normal;
            text-align: center;
            margin: 30px 0;
            letter-spacing: 1px;
            font-family: Arial, sans-serif;
        }

        /* Footer dengan SVLK Logo */
        .footer {
            text-align: center;
            margin-top: 10px;
        }

        .footer img {
            width: 250px;
            height: auto;
            /* margin-bottom: 2px; */
        }

        .footer-text {
            font-size: 20px;
            margin-top: 5px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    @foreach($barcodeData as $barcode)
    <div class="page-wrapper">
        <div class="vertical-center">
            <div class="box">
                <div class="top-section">
                    <!-- Logo Kementerian (Tree Logo) - Top Left -->
                    @if(isset($barcode['kementerian_logo']))
                        <img src="data:image/png;base64,{{ $barcode['kementerian_logo'] }}" alt="Logo" class="top-logo">
                    @endif

                    <!-- Header -->
                    <div class="header">
                        <h2>KEMENTERIAN KEHUTANAN</h2>
                        <h2>REPUBLIK INDONESIA</h2>
                    </div>

                    <div class="title">
                        <h3>PT. ITCI KARTIKA UTAMA</h3>
                    </div>
                </div>

                <!-- QR Codes Section -->
                <div class="qr-section">
                    <div class="qr-container">
                        <img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR Code">
                    </div>
                    <div class="qr-container">
                        <img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR Code">
                    </div>
                    <div class="qr-container">
                        <img src="data:image/png;base64,{{ $barcode['qr_image'] }}" alt="QR Code">
                    </div>
                </div>

                <!-- Barcode Code as Text -->
                <div class="barcode-code">{{ $barcode['code'] }}</div>

                <!-- Footer with SVLK Logo -->
                <div class="footer">
                    @if(isset($barcode['svlk_logo']))
                        <img src="data:image/png;base64,{{ $barcode['svlk_logo'] }}" alt="SVLK Logo">
                    @endif
                    <div class="footer-text">PHL-64-01-0068</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>
