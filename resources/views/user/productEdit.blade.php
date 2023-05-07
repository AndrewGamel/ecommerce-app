<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>
<body>

<form action="{{ url("/editCart/$product->id") }}" method="POST">
    @csrf
    <ul>
<li>{{ $product->title }}</li>
<li>{{ $product->price }}</li>

<div style="width: 100%;height: auto;background-color: rgb(159, 181, 159);margin: auto;padding: 15px">
  <label style="font-weight: bold;">Quantity</label>
   <input min="1" max="4" name="quantity" style="width: 100px;height: 30px;" type="number" name="quantity" value="{{ old('quantity',$cart->quantity) }}">
</div>
<div style="width: 100%;height: auto; background-color: gray;padding: 15px;margin: auto">
    <button type="submit" name="addCart">Add To Cart</button></div>

</form>

</body>
</html>