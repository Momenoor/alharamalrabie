<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Coupons</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ribbon CSS */
        .ribbon {
            position: relative;
            top: -24px;
            left: -24px;
            z-index: 1;
            overflow: hidden;
            width: 150px;
            height: 150px;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 200px;
            padding: 10px 0;
            background-color: red; /* Teal color */
            color: white;
            text-align: center;
            font-weight: bold;
            transform: rotate(-45deg); /* 45 degree rotation */
            -webkit-transform: rotate(-45deg); /* For older browsers */
            top: 20px;
            left: -55px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="ribbon">
            <span>Redeemed</span>
        </div>
        <h2 class="text-2xl text-center font-semibold text-gray-800 mb-4 -mt-40">Redeemed Coupon</h2>

        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
             alt="Company Logo" width="100px">
        <p class="text-center text-gray-600">Coupon with code <span class="text-red-500">{{$coupon->code}}</span>
            already
            redeemed.</p>

    </div>
</div>
</body>
</html>
