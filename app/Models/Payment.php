<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    use HasFactory;

    protected $fillable = [
        'team_name',
        'payment_from',
        'payment_to',
        'transaction_id',
        'approved'
    ];
}

