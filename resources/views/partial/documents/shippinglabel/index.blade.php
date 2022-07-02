<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TronicsPay</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <div align="center" style="width: 100%; vertical-align: top;">
        <img src="{{ $order['shipping_label'] }}" style="width: 96%;">
    </div>
</body>

</html>