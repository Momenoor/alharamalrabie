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

    <!-- Search and Action Buttons -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex">
            <input type="text" id="search" placeholder="Search Coupon Code"
                   class="px-4 py-2 border rounded-md text-gray-900" onkeyup="searchCoupons()">
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('coupons.generate') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-800">
                Create Coupon
            </a>
            <form action="{{ route('coupons.deleteAll') }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete All Coupons
                </button>
            </form>
        </div>
    </div>

    <!-- Check if there are any coupons -->
    @if (empty($coupons))
        <div class="text-center">
            <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}" alt="Company Logo"
                 width="100px">
            <p class="text-center text-gray-600">No coupons have been generated yet.</p>
        </div>
    @else
        <!-- Coupons Table -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden" id="coupons-table">
            <thead class="bg-teal-500 text-white">
            <tr>
                <th class="text-left py-3 px-4">Coupon Code</th>
                <th class="text-left py-3 px-4">Discount</th>
                <th class="text-left py-3 px-4">Expiry Date</th>
                <th class="text-center py-3 px-4">Redeemed</th>
                <th class="text-center py-3 px-4">Download Status</th>
                <th class="text-center py-3 px-4">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach ($coupons as $coupon)
                <tr class="border-b coupon-row">
                    <td class="py-3 px-4 coupon-code">{{ $coupon->code }}</td>
                    <td class="py-3 px-4">{{ $coupon->discount }}% OFF</td>

                    <!-- Expiry Date -->
                    <td class="py-3 px-4">
                        @if (\Carbon\Carbon::parse($coupon->expiry_date)->isPast())
                            <span class="text-red-500 line-through">{{ $coupon->expiry_date }}</span>
                        @else
                            {{ $coupon->expiry_date }}
                        @endif
                    </td>

                    <!-- Redeemed Status -->
                    <td class="py-3 px-4 text-center">
                        @if ($coupon->is_redeemed)
                            <span class="text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg> Redeemed
                            </span>
                        @else
                            <span class="text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2l4-4"/>
                                </svg> Not Redeemed
                            </span>
                        @endif
                    </td>

                    <!-- Download Status -->
                    <td class="py-3 px-4 text-center">
                        @if ($coupon->is_downloaded)
                            <span class="text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg> Downloaded
                            </span>
                        @else
                            <span class="text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 4v16h16V4z"/>
                                </svg> Not Downloaded
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="py-3 px-4 text-end">
                        @if (!\Carbon\Carbon::parse($coupon->expiry_date)->isPast())
                            <!-- Show redeem button only if not redeemed and not expired -->
                            @if (!$coupon->is_redeemed)
                                <form action="{{ route('coupons.redeem', $coupon->code) }}" method="GET" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-600">Redeem
                                    </button>
                                </form>
                            @endif

                            <!-- Show download button only if not downloaded and not expired -->
                            @if (!$coupon->is_downloaded)
                                <button class="text-indigo-600 hover:underline ml-4 download-btn" data-coupon-id="{{ $coupon->id }}">Download</button>
                            @endif
                        @else
                            <!-- If expired, show a message -->
                            <span class="text-gray-400">Expired</span>
                        @endif
                        <form action="{{ route('coupons.delete', $coupon) }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- JavaScript for Search Functionality -->
<script>
    function searchCoupons() {
        let input = document.getElementById('search');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('coupons-table');
        let rows = table.getElementsByClassName('coupon-row');

        for (let i = 0; i < rows.length; i++) {
            let codeCell = rows[i].getElementsByClassName('coupon-code')[0];
            let codeText = codeCell.textContent || codeCell.innerText;

            if (codeText.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

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
