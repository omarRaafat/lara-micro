<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
<div>
    <h1>{{$title}}</h1>

    <p>Invoice :  {{$invoice_number}}.</p>

    <img src="data:image/png;base64,{{ base64_encode($qrcode) }}">

</div>
</body>
</html>
