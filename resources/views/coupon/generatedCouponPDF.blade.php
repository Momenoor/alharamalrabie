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
        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}" alt="Company Logo"
             width="100px">
        <p class="text-center text-gray-600">No coupons have been generated yet.</p>
    @else
        <div class="flex justify-between items-center mb-4">
            <div class="flex">
                <!-- Search Input -->
                <input type="text" id="search" placeholder="Search Coupon Code"
                       class="px-4 py-2 border rounded-md text-gray-900" onkeyup="searchCoupons()">
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('coupons.list') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-800">
                    See All Coupons
                </a>
                <form action="{{ route('coupons.deleteAll') }}" method="POST"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete All Coupons
                    </button>
                </form>
            </div>
        </div>

        <!-- Coupon Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="coupons-container">
            @foreach ($coupons as $coupon)
                <div class="bg-white rounded-lg shadow-md overflow-hidden coupon-item">
                    <!-- Coupon Header -->
                    <div class="bg-teal-500 text-white text-center py-4">
                        <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
                             alt="Company Logo" width="100px">
                        <h2 class="text-2xl font-bold coupon-code">Coupon Code: {{ $coupon->code }}</h2>
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
                            @if($isAll)
                                <button class="text-indigo-600 hover:underline font-bold download-btn"
                                        data-coupon-id="{{ $coupon->id }}">Download Coupon PDF
                                </button>
                            @else
                                <a class="text-indigo-600 hover:underline font-bold"
                                   href="{{route('coupons.download',$coupon)}}">Download Coupon PDF</a>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- JavaScript to handle search and download functionality -->
<script>
    // Function for search functionality
    function searchCoupons() {
        // Get the search input and convert it to uppercase
        let input = document.getElementById('search').value.toUpperCase();

        // Get all coupon items
        let couponItems = document.getElementsByClassName('coupon-item');

        // Loop through all coupon items and hide those that don't match the search query
        for (let i = 0; i < couponItems.length; i++) {
            // Get the coupon code element inside the coupon item
            let codeElement = couponItems[i].getElementsByClassName('coupon-code')[0];

            // If the coupon code matches the search query, show the item; otherwise, hide it
            if (codeElement.textContent.toUpperCase().includes(input)) {
                couponItems[i].style.display = "";
            } else {
                couponItems[i].style.display = "none";
            }
        }
    }

    // Function for handling download and refresh
    document.addEventListener('DOMContentLoaded', function () {
        let downloadButtons = document.querySelectorAll('.download-btn');

        downloadButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Get coupon ID from the button's data attribute
                let couponId = this.getAttribute('data-coupon-id');

                // Create a hidden anchor tag to trigger the file download
                let link = document.createElement('a');
                link.href = `/download/${couponId}`;
                link.download = true;

                // Append the link to the body and click it to start the download
                document.body.appendChild(link);
                link.click();

                // Remove the link after download
                document.body.removeChild(link);

                // Refresh the page after download
                setTimeout(function () {
                    location.reload();
                }, 1000);  // Wait 1 second before refreshing the page
            });
        });
    });
</script>

</body>
</html>
