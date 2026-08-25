<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'content_html',
        'status',
        'scheduled_at',
        'category',
        'ai_prompt_used',
        'sent_count',
        'total_recipients',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function sends()
    {
        return $this->hasMany(BulletinSend::class);
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->total_recipients == 0) return 0;
        return (int) round(($this->sent_count / $this->total_recipients) * 100);
    }
}
