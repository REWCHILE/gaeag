<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'rut',
        'sec_licence',
        'category',
        'class',
        'phone',
        'email',
        'city',
        'region',
        'bio',
        'status',
    ];
}
