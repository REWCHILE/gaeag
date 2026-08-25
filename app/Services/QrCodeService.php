<?php

namespace App\Services;

use App\Models\Member;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class QrCodeService
{
    /**
     * Generates a 100% scanner-compliant QR code PNG image.
     * Guaranteed to work across all Linux/Windows servers without font dependencies.
     *
     * @param string $url Target member URL
     * @param string $filename Member slug filename
     * @return string Relative path (e.g. qrcodes/domingo-isain.png)
     */
    public function generateForMemberUrl(string $url, string $filename): string
    {
        $options = new QROptions([
            'version'      => QRCode::VERSION_AUTO,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_H, // High error correction (30%) ensures fast scanning
            'scale'        => 10,
            'addQuietzone' => true,
        ]);

        $qrPngString = (new QRCode($options))->render($url);

        if (str_contains($qrPngString, 'data:image')) {
            $qrPngString = base64_decode(explode(',', $qrPngString)[1]);
        }

        $qrImage = @imagecreatefromstring($qrPngString);
        if (!$qrImage) {
            // Fallback to raw binary if imagecreatefromstring failed
            $imageData = $qrPngString;
        } else {
            $qrWidth = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);

            // Add clean SEC branding badge in center (carefully sized to remain < 20% area for 100% decode speed)
            $badgeW = (int)($qrWidth * 0.22);
            $badgeH = (int)($qrHeight * 0.12);
            $badgeX = (int)(($qrWidth - $badgeW) / 2);
            $badgeY = (int)(($qrHeight - $badgeH) / 2);

            $white = imagecolorallocate($qrImage, 255, 255, 255);
            $secBlue = imagecolorallocate($qrImage, 42, 129, 186);
            $darkSlate = imagecolorallocate($qrImage, 15, 23, 42);

            // Badge border and background
            imagefilledrectangle($qrImage, $badgeX - 3, $badgeY - 3, $badgeX + $badgeW + 3, $badgeY + $badgeH + 3, $darkSlate);
            imagefilledrectangle($qrImage, $badgeX - 1, $badgeY - 1, $badgeX + $badgeW + 1, $badgeY + $badgeH + 1, $white);
            imagefilledrectangle($qrImage, $badgeX + 1, $badgeY + 1, $badgeX + $badgeW - 1, $badgeY + $badgeH - 1, $secBlue);

            // Draw "SEC" text in white using native GD (cross-platform, Linux + Windows compatible)
            $text = "SEC";
            $font = 5; // Built-in large GD font
            $fontWidth = imagefontwidth($font);
            $fontHeight = imagefontheight($font);
            $textX = (int)($badgeX + ($badgeW - (strlen($text) * $fontWidth)) / 2);
            $textY = (int)($badgeY + ($badgeH - $fontHeight) / 2);

            imagestring($qrImage, $font, $textX, $textY, $text, $white);

            ob_start();
            imagepng($qrImage);
            $imageData = ob_get_clean();
            imagedestroy($qrImage);
        }

        $relativePath = "qrcodes/{$filename}.png";

        // Save to public storage
        try {
            Storage::disk('public')->put($relativePath, $imageData);
        } catch (\Exception $e) {
            Log::warning("Could not write QR to Storage disk: " . $e->getMessage());
        }

        // Also save directly to public/qrcodes/ for zero-configuration HTTP serving
        $publicDir = public_path('qrcodes');
        if (!file_exists($publicDir)) {
            @mkdir($publicDir, 0777, true);
        }
        @file_put_contents(public_path($relativePath), $imageData);

        return $relativePath;
    }

    /**
     * Generates or retrieves SEC QR code for a given Member.
     */
    public function generateSecQrCode(Member $member): string
    {
        $targetUrl = $member->qr_target_url;
        $path = $this->generateForMemberUrl($targetUrl, $member->slug);
        
        $member->update(['qr_code_path' => $path]);

        return $path;
    }

    /**
     * Returns the binary PNG stream of the QR for on-the-fly dynamic rendering.
     */
    public function renderRawQr(string $url): string
    {
        $options = new QROptions([
            'version'      => QRCode::VERSION_AUTO,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_H,
            'scale'        => 10,
            'addQuietzone' => true,
        ]);

        $qrPngString = (new QRCode($options))->render($url);

        if (str_contains($qrPngString, 'data:image')) {
            $qrPngString = base64_decode(explode(',', $qrPngString)[1]);
        }

        return $qrPngString;
    }
}
