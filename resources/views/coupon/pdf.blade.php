<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupons PDF</title>
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Your Exclusive Coupons</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Coupon Header -->
            <div class="bg-teal-600 text-white text-center py-4">
                <h2 class="text-2xl font-bold tracking-wide">Coupon Code</h2>
                <p class="text-4xl font-extrabold mt-2">{{ $coupon->code }}</p>
            </div>

            <!-- Coupon Details -->
            <div class="p-6">
                <div class="text-center">
                    <p class="text-lg font-medium text-gray-500">Get</p>
                    <p class="text-5xl font-bold text-teal-600">{{ $coupon->discount }}% OFF</p>
                    <p class="text-lg font-medium text-gray-500 mt-4">On your next purchase</p>
                </div>

                <!-- Expiry Date -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-400">Valid Until:</p>
                    <p class="text-md font-semibold text-gray-700">{{ $coupon->expiry_date }}</p>
                </div>
            </div>

            <!-- Coupon Footer with CTA -->
            <div class="bg-gray-50 py-4 text-center">
                <p class="text-gray-500 text-sm">Redeem this coupon at checkout.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
