<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order PDF</title>
</head>
<body>
   <h1>Order Details</h1>

   Customer's Name:<h3>{{$order->name}}</h3>
   Customer's ID:<h3>{{$order->user_id}}</h3>
   Customer's Phone Number:<h3>{{$order->phone}}</h3>
   Customer's Email Address:<h3>{{$order->email}}</h3>
   Customer's Address:<h3>{{$order->address}}</h3>
   Product's Title<h3>{{$order->product_title}}</h3>
   Quantity<h3>{{$order->quantity}}</h3>
   Product's Price:<h3>{{$order->price}}</h3>
   Payment:<h3>{{$order->payment_status}}</h3>
   Product's ID:<h3>{{$order->product_id}}</h3>
   <br><br>
   <img height="200" width="250" src="product/{{$order->image}}">
</body>
</html>