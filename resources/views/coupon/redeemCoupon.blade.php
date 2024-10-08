<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Coupons</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Redeem Coupons</h2>

        <!-- Coupon Generation Form -->
        <form action="{{ route('coupons.confirmRedeem',$coupon) }}" method="POST">
            @csrf
            <div class="text-center">
                <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
                     alt="Company Logo" width="100px">
                <h1 class="text-2xl font-bold">{{$coupon->code}}</h1>
            </div>
            <div class="mb-4">
                <label for="discount" class="block text-sm font-medium text-gray-700">Marchand Passkey</label>
                <input type="number" name="passkey" id="passkey" required
                       class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                @if ($errors->has('passkey'))
                    <span class="text-red-500 text-sm">{{ $errors->first('passkey') }}</span>
                @endif
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Confirm
            </button>
        </form>
    </div>
</div>
</body>
</html>
