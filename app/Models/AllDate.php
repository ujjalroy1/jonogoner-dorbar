<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllDate extends Model
{
        use HasFactory;

    protected $fillable = [
        'ovijog_id',
        'creation_date',
        'processing_date',
        'date_list',
        'complete_date',
    ];

    protected $casts = [
        'date_list' => 'array', // cast JSON to array automatically
        'creation_date' => 'date',
        'processing_date' => 'date',
        'complete_date' => 'date',
    ];

    public function ovijog()
    {
        return $this->belongsTo(Ovijog::class);
    }
}
