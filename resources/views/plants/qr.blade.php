<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code for {{ $plant->plant_name }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .qr-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }
        p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h1>{{ $plant->plant_name }}</h1>
        <p>{{ $plant->latin_name }}</p>
        <div class="qr-code">
            {!! $qrCode !!}
        </div>
        <p style="margin-top: 20px;">Scan untuk melihat detail tanaman</p>
        <small>URL: {{ route('plants.show', $plant) }}</small>
    </div>
</body>
</html>