<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Optional: Add custom styles for countdown */
        .countdown {
            display: flex;
            gap: 2rem;
        }

        .countdown div {
            text-align: center;
        }
    </style>
</head>
<body
    class="bg-gradient-to-r from-red-500 to-amber-600 text-white min-h-screen flex flex-col justify-center items-center">

<!-- Hero Section -->
<div class="text-center">
    <!-- Logo or Branding -->
    <img style="display: block; margin: 0 auto;" class="" src="{{ asset('logo.png') }}"
         alt="Company Logo" width="300px">
    <h1 class="text-5xl font-bold mb-8">We Are Coming Soon</h1>
    <p class="text-lg mb-8">Our website is under construction, but we are launching soon. Stay tuned!</p>

    <!-- Countdown Timer (Placeholder) -->
    <div class="countdown mb-12 flex items-center justify-center">
        <div>
            <span class="text-5xl font-bold" id="days">00</span>
            <p class="text-sm">Days</p>
        </div>
        <div>
            <span class="text-5xl font-bold" id="hours">00</span>
            <p class="text-sm">Hours</p>
        </div>
        <div>
            <span class="text-5xl font-bold" id="minutes">00</span>
            <p class="text-sm">Minutes</p>
        </div>
        <div>
            <span class="text-5xl font-bold" id="seconds">00</span>
            <p class="text-sm">Seconds</p>
        </div>
    </div>

</div>

<!-- Footer (Optional) -->
<footer class="absolute bottom-4 text-sm">
    <p>&copy; 2024 YourCompany. All Rights Reserved.</p>
</footer>

<script>
    // Countdown Timer Logic (You can replace this with your own launch date)
    const countdownDate = new Date("2024-12-20T00:00:00").getTime();

    const countdownFunction = setInterval(function () {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        // Time calculations
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the elements
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the countdown is over
        if (distance < 0) {
            clearInterval(countdownFunction);
            document.querySelector(".countdown").innerHTML = "We Have Launched!";
        }
    }, 1000);
</script>

</body>
</html>
