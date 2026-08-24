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
        'test_token',
        'psych_status',
        'psych_score_total',
        'psych_score_safety',
        'psych_score_stress',
        'psych_score_ethics',
        'psych_score_service',
        'psych_score_responsibility',
        'psych_risk_level',
        'psych_profile_summary',
        'psych_answers',
        'psych_completed_at',
    ];

    protected $casts = [
        'psych_answers' => 'array',
        'psych_completed_at' => 'datetime',
        'psych_score_total' => 'integer',
        'psych_score_safety' => 'integer',
        'psych_score_stress' => 'integer',
        'psych_score_ethics' => 'integer',
        'psych_score_service' => 'integer',
        'psych_score_responsibility' => 'integer',
    ];

    public function getTestUrlAttribute(): string
    {
        return route('psych.test', ['token' => $this->test_token]);
    }
}
