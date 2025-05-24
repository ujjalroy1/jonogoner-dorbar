<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ovijog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'type',
        'address',
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
