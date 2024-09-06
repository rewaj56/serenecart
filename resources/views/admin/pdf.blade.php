<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .invoice {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .invoice-header {
            text-align: center;
        }

        .invoice-title {
            font-size: 24px;
            margin-bottom: 20px;
            background-color: #5e8e8b;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h3 {
            font-size: 16px;
            margin: 5px 0;
            color: #333; /* Dark gray for text */
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            color: #333; /* Dark gray for text */
        }

        .invoice-total {
            text-align: right;
            margin-top: 20px;
        }

        .invoice-total h3 {
            font-size: 16px;
            margin: 5px 0;
            color: #5e8e8b; /* Green for total price */
        }

        .unit-price {
            font-weight: bold;
            color: #5e8e8b; /* Green for unit price */
        }
    </style>
</head>

<body>
    <?php 
        $unit_price = $order->price / $order->quantity;
    ?>
    <div class="invoice">
        <div class="invoice-header">
            <h1 class="invoice-title">Order Details</h1>
        </div>
        <div class="invoice-details">
            <h3>Customer Name: <span>{{$order->name}}</span></h3>
            <h3>Customer Email: <span>{{$order->email}}</span></h3>
            <h3>Customer Phone: <span>{{$order->phone}}</span></h3>
            <h3>Customer Address: <span>{{$order->address}}</span></h3>
            <h3>Customer Id: <span>{{$order->user_id}}</span></h3>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td class="unit-price">${{number_format($unit_price, 2)}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{number_format($order->price, 2)}}</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-total">
            <h3>Total Price: <span>${{number_format($order->price, 2)}}</span></h3>
        </div>
        <div class="invoice-details">
            <h3>Payment Status: <span>{{$order->payment_status}}</span></h3>
        </div>
    </div>
</body>

</html>
