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
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Generate Coupons</h2>

        <!-- Coupon Generation Form -->
        <form action="{{ route('coupons.generate') }}" method="POST">
            @csrf
            <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
                 alt="Company Logo" width="100px">
            <div class="mb-4">
                <label for="discount" class="block text-sm font-medium text-gray-700">Discount Percentage</label>
                <input type="number" name="discount" id="discount" min="1" max="100" required value="{{old('discount')}}"
                       class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                @if ($errors->has('discount'))
                    <span class="text-red-500 text-sm">{{ $errors->first('discount') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <label for="count" class="block text-sm font-medium text-gray-700">Number of Coupons</label>
                <input type="number" name="count" id="count" min="1" required value="{{old('count')}}"
                       class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                @if ($errors->has('count'))
                    <span class="text-red-500 text-sm">{{ $errors->first('count') }}</span>
                @endif
            </div>

            <div class="mb-6">
                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" required value="{{old('expiry_date')}}"
                       class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500">
                @if ($errors->has('expiry_date'))
                    <span class="text-red-500 text-sm">{{ $errors->first('expiry_date') }}</span>
                @endif
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Generate Coupons
            </button>
        </form>
    </div>
</div>
</body>
</html>
