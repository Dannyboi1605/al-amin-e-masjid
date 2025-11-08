<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_email',
        'amount',
        'payment_method',
        'transaction_status',
        'receipt_number',
        'user_id',
        'transaction_id', // Ini untuk simpan BillCode dari ToyyibPay
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}