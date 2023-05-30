<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>

<h1>Purchase confirmation{{ $booking -> firstname }} {{ $booking -> lastname }}!</h1>

<h2>Order number: {{$purchase -> id}}</h2>

<p>Dear {{$purchase -> client_name}}, thank you for purchasing the following bouquet: </p>

<ul>
    <li>Name: {{ $bouquetName -> name }}</li>
    <li>Price: {{ $bouquetPrice -> price }}</li>
</ul>

<p>Regards from the Howest Flowershop</p>

</body>
</html>
