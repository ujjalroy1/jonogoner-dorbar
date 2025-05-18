<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution',
        'team_name',

        'member1_name',
        'member1_id',
        'member1_email',
        'member1_phone',
        'member1_tshirt_size',
        'member2_name',
        'member2_id',
        'member2_email',
        'member2_phone',
        'member2_tshirt_size',
        'member3_name',
        'member3_id',
        'member3_email',
        'member3_phone',
        'member3_tshirt_size',

        'coach_name',
        'coach_email',
        'coach_phone',
        'coach_tshirt_size',

        'approve',
        'payment'
    ];
}
