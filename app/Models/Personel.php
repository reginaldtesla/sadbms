<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'personnel_type',
        'department',
        'supervision_name',
        'assigned_role',
        'institution_name',
        'remarks',
        'duration',
        'start_date',
        'end_date',
        'address',
        'bio',
        'program',
        'photo',
        'user_id'
    ];
}
