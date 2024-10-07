<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupons PDF</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f7fafc;
        }

        .container {
            max-width: 1024px;
            margin: 0 auto;
            padding: 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 24px;
        }

        .md-grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .lg-grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            background-color: #38b2ac;
            color: white;
            text-align: center;
            padding: 16px;
        }

        .header h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .header p {
            font-size: 32px;
            font-weight: 900;
            margin-top: 8px;
        }

        .content {
            padding: 24px;
            text-align: center;
        }

        .content p {
            margin: 16px 0;
            font-size: 18px;
            color: #4a5568;
        }

        .discount {
            font-size: 40px;
            font-weight: bold;
            color: #38b2ac;
        }

        .note {
            font-size: 12px;
            font-weight: bold;
            color: #e53e3e;
        }

        .expiry-date {
            margin-top: 24px;
            font-size: 14px;
            color: #a0aec0;
        }

        .expiry-date span {
            font-size: 16px;
            font-weight: 600;
            color: #4a5568;
        }

        .footer {
            background-color: #edf2f7;
            text-align: center;
            padding: 16px;
        }

        .footer p {
            font-size: 12px;
            color: #718096;
        }

        .redeemed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(74, 85, 104, 0.75);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .redeemed-overlay h2 {
            font-size: 36px;
            font-weight: bold;
            color: #f56565;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center; font-size: 24px; font-weight: bold; color: #2d3748; margin-bottom: 32px;">Your
        Exclusive Coupons</h1>

    <div class="grid md-grid-2 lg-grid-3">
        <div class="card">
            @if ($coupon->is_redeemed)
                <div class="redeemed-overlay">
                    <h2>Redeemed</h2>
                </div>
            @endif
            <!-- Coupon Header -->
            <div class="header">
                <h2>Coupon Code</h2>
                <p>{{ $coupon->code }}</p>
            </div>

            <!-- Coupon Details -->
            <div class="content">
                <p>Get</p>
                <p class="discount">{{ $coupon->discount }}% OFF</p>
                <p>On your next purchase</p>

                <!-- Note: Redeem Once -->
                <p class="note">Note: This coupon can be redeemed only once.</p>

                <!-- Expiry Date -->
                <div class="expiry-date">
                    <p>Valid Until: <span>{{ $coupon->expiry_date }}</span></p>
                </div>
            </div>

            <!-- Coupon Footer with CTA -->
            <div class="footer">
                <p>Redeem this coupon at checkout.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
