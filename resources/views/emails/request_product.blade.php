<!DOCTYPE html>
<html>
<head>
    <title>Product Request</title>
</head>
<body>
    <h2>A Product has been Requested</h2>
    <p><strong>Product ID:</strong> {{ $data['product_name'] }}</p>
    <p><strong>Delivery Method ID:</strong> {{ $data['delivery_method_name'] }}</p>
    <p><strong>Quantity:</strong> {{ $data['quantity_requested'] }}</p>
</body>
</html>
