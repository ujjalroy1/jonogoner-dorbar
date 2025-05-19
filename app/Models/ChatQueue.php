<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatQueue extends Model
{
    protected $fillable = ['user_id', 'status'];
}