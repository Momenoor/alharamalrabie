<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Passcode</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
             alt="Company Logo" width="100px">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Enter Passcode</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Passcode Form -->
        <form action="{{ route('passcode.verify') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="passcode" class="block text-sm font-medium text-gray-700">Passcode:</label>
                <input type="text" name="passcode" id="passcode" required
                       class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
