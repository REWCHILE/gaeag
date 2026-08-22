<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentGrid extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'category',
        'frequency',
        'scheduled_date',
        'status',
        'bulletin_id',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class);
    }
}
