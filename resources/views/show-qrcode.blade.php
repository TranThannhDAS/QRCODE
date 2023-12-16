<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div id="downloadQR" style=" width: 250px; position: absolute; right: 4px; height: 250px; top: 203px;">
        @if ($image = Session::get('qrcode'))
        <div style="width: 100%; height: 100%;">
            <img style="width: 100%; height: 100%;" src="data:image/png;base64,{{ base64_encode($image) }}" alt="QR Code">
        </div>
        <div style=" width: 100%; text-align: center; padding: 2px 4px; border: 1px solid;     margin-top: 5px; border-radius: 5px; background-color: #007bff;">
            <a type="button" style="color: white" href="data:image/png;base64,{{ base64_encode($image) }} " download>Downloads</a>
        </div>
        @endif
    </div>
</body>
</html>