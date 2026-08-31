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
            $webpName = pathinfo($cleanPath, PATHINFO_FILENAME) . '.webp';

            // Check if WebP version exists first
            if (file_exists(public_path('images/members/' . $webpName))) {
                return asset('images/members/' . $webpName);
            }
            if (file_exists(public_path('images/' . $webpName))) {
                return asset('images/' . $webpName);
            }
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
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=1a6494&color=ffffff&size=256';
    }

    public function getQrCodeUrlAttribute(): string
    {
        // 1. Check if pre-generated file exists in public/qrcodes/
        $slugName = $this->slug;
        $directPublicFile = public_path("qrcodes/{$slugName}.png");
        if (file_exists($directPublicFile)) {
            return asset("qrcodes/{$slugName}.png");
        }

        if ($this->qr_code_path) {
            if (str_starts_with($this->qr_code_path, 'http://') || str_starts_with($this->qr_code_path, 'https://')) {
                return $this->qr_code_path;
            }
            $cleanPath = ltrim($this->qr_code_path, '/');
            if (file_exists(public_path($cleanPath))) {
                return asset($cleanPath);
            }
        }

        // 2. Auto-generate file dynamically on the fly
        try {
            $qrService = app(\App\Services\QrCodeService::class);
            $path = $qrService->generateSecQrCode($this);
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        } catch (\Throwable $e) {
            // Fallback to inline Base64 data URI if disk write is restricted
            try {
                $rawPng = app(\App\Services\QrCodeService::class)->renderRawQr($this->qr_target_url);
                return 'data:image/png;base64,' . base64_encode($rawPng);
            } catch (\Throwable $ex) {
                // Ignore
            }
        }

        return route('members.qr_image', ['slug' => $this->slug]);
    }
}
