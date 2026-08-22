<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinSend extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulletin_id',
        'member_id',
        'email',
        'status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
