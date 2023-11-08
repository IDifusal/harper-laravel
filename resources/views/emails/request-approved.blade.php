<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .email-container {
            background-color: #f7f7f7;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .email-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }
        .email-header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <div class="email-header">
                Request Approval
            </div>
            <p>Your request was approved!</p>
            <p><strong>Product:</strong> {{ $data['product_name'] }}</p>
            <p><strong>Delivery Method:</strong> {{ $data['delivery_method_name'] }}</p>
            <p><strong>Quantity:</strong> {{ $data['quantity_requested'] }}</p>
        </body>
        </div>
    </div>
</body>
</html>
