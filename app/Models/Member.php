<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'full_name',
        'rut',
        'sec_licence',
        'sec_qr_url',
        'category',
        'class',
        'title',
        'phone',
        'email',
        'city',
        'region',
        'bio',
        'photo_path',
        'is_active',
        'is_verified',
        'qr_code_path',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getPublicUrlAttribute(): string
    {
        return url("/profesionales/{$this->slug}");
    }

    public function getQrTargetUrlAttribute(): string
    {
        return $this->sec_qr_url ?: $this->public_url;
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=2a81ba&color=ffffff&size=256';
    }

    public function getQrCodeUrlAttribute(): ?string
    {
        if ($this->qr_code_path) {
            return asset('storage/' . $this->qr_code_path);
        }
        return null;
    }
}
