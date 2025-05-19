<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ovijog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'attachment',
        'hide',
        'status',
        'feedback',
        'comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
