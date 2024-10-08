<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount',
        'expiry_date',
        'is_redeemed',
        'is_admin_redeemed',
        'download_link',
    ];

}
