<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::all();
        return view('coupon.generatedCouponPDF', compact('coupons'));
    }

    //
    public function showGenerateForm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('coupon.generateCouponForm');
    }

    public function generateCoupons(Request $request): \Illuminate\View\View
    {
        // Validate the incoming request
        $request->validate([
            'discount' => 'required|numeric|min:1|max:100',
            'count' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after:today',
        ]);

        $coupons = [];

        // Loop to create multiple coupons
        for ($i = 0; $i < $request->get('count'); $i++) {
            // Generate a unique code
            $code = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
            //$qrCodeImage = 'coupons/' . $code . '-qrcode.png';
            //$qrCode = Storage::disk('public')->put('qrcodes/' . $qrCodeImage, QrCode::format('png')->size(100)->generate(url('redeem/' . $code)));
            // Create the coupon in the database
            $coupon = Coupon::query()->create([
                'code' => $code,
                'discount' => $request->get('discount'),
                'expiry_date' => $request->get('expiry_date'),
            ]);

            $path = public_path('logo.png'); // Adjust this if needed
            $logo = base64_encode(file_get_contents($path));
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $logo_src = 'data:image/' . $type . ';base64,' . $logo;

            // Generate the PDF for the coupon
            $pdf = Pdf::loadView('coupon.generateCouponPDF', ['coupon' => $coupon, 'logo' => $logo_src]);

            // Define the file name and store the PDF
            $fileName = $coupon->code . '.pdf';
            Storage::disk('public')->put('coupons/' . $fileName, $pdf->output());

            // Add the coupon to the array for further use
            $coupons[] = $coupon;
        }

        // Return the view with the generated coupons and their download links
        return view('coupon.generatedCouponPDF', ['coupons' => $coupons]);
    }

    public function redeem($code): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $coupon = Coupon::query()->where('code', $code)->first();
        if (Carbon::parse($coupon->expiry_date)->isBefore(now())) {
            return view('coupon.expiredCoupon', compact('coupon'));
        }
        if ($coupon->is_redeemed) {
            return view('coupon.redeemedCoupon', compact('coupon'));
        }
        return view('coupon.redeemCoupon', compact('coupon'));
    }

    public function confirmRedeem(Request $request, Coupon $coupon): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $passkey = env('PASSKEY');
        $request->validate([
            'passkey' => 'required|in:' . $passkey,
        ]);
        $coupon->update([
            'is_redeemed' => 1,
        ]);
        return view('coupon.redeemSuccess', compact('coupon'));
    }

    public function download(Coupon $coupon)
    {
        // File path in 'public' disk (storage/app/public)
        $filePath = 'coupons/' . $coupon->code . '.pdf';

        // Check if the file exists in the 'public' disk
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }
        $coupon->is_downloaded = true;
        $coupon->save();
        // Return the file as a download response
        return Storage::disk('public')->download($filePath);

    }


    public function show(Coupon $coupon): \Illuminate\Contracts\View\View
    {
        return view('coupon.show', compact('coupon'));
    }
}
