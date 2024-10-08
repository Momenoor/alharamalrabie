<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Coupons</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">All Generated Coupons</h1>

    <!-- Check if there are any coupons -->
    @if (empty($coupons))
        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
             alt="Company Logo" width="100px">
        <p class="text-center text-gray-600">No coupons have been generated yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($coupons as $coupon)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Coupon Header -->
                    <div class="bg-teal-500 text-white text-center py-4">
                        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
                             alt="Company Logo" width="100px">
                        <h2 class="text-2xl font-bold">Coupon Code: {{ $coupon->code }}</h2>
                    </div>

                    <!-- Coupon Details -->
                    <div class="p-6">
                        <p class="text-lg font-medium text-gray-500 text-center">Discount: <span
                                class="text-indigo-600 font-bold">{{ $coupon->discount }}% OFF</span></p>
                        <p class="text-sm text-gray-500 text-center mt-2">Expiry Date: {{ $coupon->expiry_date }}</p>

                        <!-- Redeemed Status -->
                        <p class="text-center mt-4">
                            @if ($coupon->is_redeemed)
                                <span class="bg-red-500 text-white px-3 py-1 rounded">Redeemed</span>
                            @else
                                <span class="bg-green-500 text-white px-3 py-1 rounded">Not Redeemed</span>
                            @endif
                        </p>
                    </div>

                    <!-- Download Link -->
                    <div class="bg-gray-50 py-4 text-center">
                        @if($coupon->is_downloaded)
                            Already Downloaded.
                        @else
                            <a href="{{ route('coupons.download',$coupon) }}"
                               class="text-indigo-600 hover:underline font-bold"
                               download>Download Coupon PDF</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</body>
</html>
