<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;

class QrCodeService
{
    /**
     * Generates an official SEC-styled PNG QR code with centered SEC badge
     * and blue corner dots, saving it to public storage.
     *
     * @param string $url Target member URL
     * @param string $filename Member slug filename
     * @return string Relative path in public storage (e.g. qrcodes/domingo-isain.png)
     */
    public function generateForMemberUrl(string $url, string $filename): string
    {
        $options = new QROptions([
            'version'      => QRCode::VERSION_AUTO,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_H, // 30% error recovery allows SEC logo overlay
            'scale'        => 12,
            'addQuietzone' => true,
        ]);

        $qrPngString = (new QRCode($options))->render($url);

        if (str_contains($qrPngString, 'data:image')) {
            $qrPngString = base64_decode(explode(',', $qrPngString)[1]);
        }

        $qrImage = imagecreatefromstring($qrPngString);
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);

        $white = imagecolorallocate($qrImage, 255, 255, 255);
        $black = imagecolorallocate($qrImage, 15, 23, 42);
        $secBlue = imagecolorallocate($qrImage, 42, 129, 186);

        // SEC Corner Blue Dots
        $moduleSize = 12;
        $quietZonePx = 4 * $moduleSize;
        $finderCenterOffset = $quietZonePx + (3.5 * $moduleSize);
        $circleRadius = 1.8 * $moduleSize;

        // Top-Left Corner
        imagefilledellipse($qrImage, (int)$finderCenterOffset, (int)$finderCenterOffset, (int)($circleRadius * 2), (int)($circleRadius * 2), $secBlue);

        // Top-Right Corner
        $topRightX = $qrWidth - $finderCenterOffset;
        imagefilledellipse($qrImage, (int)$topRightX, (int)$finderCenterOffset, (int)($circleRadius * 2), (int)($circleRadius * 2), $secBlue);

        // Bottom-Left Corner
        $bottomLeftY = $qrHeight - $finderCenterOffset;
        imagefilledellipse($qrImage, (int)$finderCenterOffset, (int)$bottomLeftY, (int)($circleRadius * 2), (int)($circleRadius * 2), $secBlue);

        // SEC Logo Badge in Center
        $logoWidth = (int)($qrWidth * 0.28);
        $logoHeight = (int)($qrHeight * 0.16);
        $logoX = (int)(($qrWidth - $logoWidth) / 2);
        $logoY = (int)(($qrHeight - $logoHeight) / 2);

        imagefilledrectangle($qrImage, $logoX - 4, $logoY - 4, $logoX + $logoWidth + 4, $logoY + $logoHeight + 4, $black);
        imagefilledrectangle($qrImage, $logoX - 2, $logoY - 2, $logoX + $logoWidth + 2, $logoY + $logoHeight + 2, $white);

        $fontFile = 'C:\\Windows\\Fonts\\arialbd.ttf';
        if (file_exists($fontFile)) {
            $fontSize = (int)($logoHeight * 0.45);
            $bbox = imagettfbbox($fontSize, 0, $fontFile, 'SEC');
            $textWidth = abs($bbox[4] - $bbox[0]);
            $textHeight = abs($bbox[5] - $bbox[1]);
            $textX = $logoX + ($logoWidth - $textWidth) / 2;
            $textY = $logoY + ($logoHeight + $textHeight) / 2 - 2;
            
            imagettftext($qrImage, $fontSize, 0, (int)$textX, (int)$textY, $black, $fontFile, 'SEC');
            imagefilledrectangle($qrImage, (int)($textX + $textWidth * 0.42), (int)($textY - $textHeight * 0.4), (int)($textX + $textWidth * 0.62), (int)($textY - $textHeight * 0.25), $secBlue);
        } else {
            imagestring($qrImage, 5, (int)($logoX + $logoWidth / 4), (int)($logoY + $logoHeight / 3), 'SEC', $black);
        }

        // Save to public storage
        $relativePath = "qrcodes/{$filename}.png";
        
        ob_start();
        imagepng($qrImage);
        $imageData = ob_get_clean();
        imagedestroy($qrImage);

        Storage::disk('public')->put($relativePath, $imageData);

        return $relativePath;
    }
}
