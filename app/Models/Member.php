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
            if (str_starts_with($this->photo_path, 'http://') || str_starts_with($this->photo_path, 'https://')) {
                return $this->photo_path;
            }
            $cleanPath = ltrim($this->photo_path, '/');
            if (file_exists(public_path($cleanPath))) {
                return asset($cleanPath);
            }
            if (file_exists(public_path('images/' . basename($cleanPath)))) {
                return asset('images/' . basename($cleanPath));
            }
            if (file_exists(public_path('images/members/' . basename($cleanPath)))) {
                return asset('images/members/' . basename($cleanPath));
            }
            return asset('storage/' . $cleanPath);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=2a81ba&color=ffffff&size=256';
    }

    public function getQrCodeUrlAttribute(): ?string
    {
        if ($this->qr_code_path) {
            if (str_starts_with($this->qr_code_path, 'http://') || str_starts_with($this->qr_code_path, 'https://')) {
                return $this->qr_code_path;
            }
            $cleanPath = ltrim($this->qr_code_path, '/');
            if (file_exists(public_path($cleanPath))) {
                return asset($cleanPath);
            }
            if (file_exists(public_path('qrcodes/' . basename($cleanPath)))) {
                return asset('qrcodes/' . basename($cleanPath));
            }
            return asset('storage/' . $cleanPath);
        }
        return null;
    }
}
