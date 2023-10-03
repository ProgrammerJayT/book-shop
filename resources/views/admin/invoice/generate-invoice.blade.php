<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{$order->order_id}}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .status-h{
            text-transform: uppercase;
            color:#28a745;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Store In</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice #{{$order->order_id}}</span> <br>
                    <span>Date: {{date('d / m / Y')}}</span> <br>
                    <span>Zip code : 560077</span> <br>
                    <span>Address: #444, some main road, some area, some street, bangalore</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Full Name:</td>
                <td>{{$order->user->name}}</td>

                <td>Email Address:</td>
                <td>{{$order->user->email}}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{$order->created_at->format('d-m-Y')}}</td>

                <td>Phone:</td>
                <td>{{$order->user->phone}}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{$order->payment_mode}}</td>

                <td>Address:</td>
                <td>{{$order->address}}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td class="status-h">{{$order->status}}</td>

                <td>Pin code:</td>
                <td>{{$order->zip_code}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="6">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Item No</th>
                <th>Book</th>
                <th>Edition</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($order->orderItems as $key=>$item)
            <tr>
                <td width="10%">{{$key+1}}</td>
                <td width="10%">{{$item->item->name}}</td>
                <td width="10%">{{$item->item->edition}}</td>
                <td width="10%">R{{$item->price}}</td>
                <td width="10%">{{$item->quantity}}</td>
                <td width="15%" class="fw-bold">R{{$item->price * $item->quantity}}</td>
                @php
                    $totalPrice += $item->price * $item->quantity;
                @endphp
            </tr>
        @endforeach
            <tr>
                <td colspan="5" class="total-heading">Total Amount:</td>
                <td colspan="1" class="total-heading">R{{$totalPrice}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Store In
    </p>

</body>
</html>