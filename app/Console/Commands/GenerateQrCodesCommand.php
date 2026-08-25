<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Services\QrCodeService;
use Illuminate\Console\Command;

class GenerateQrCodesCommand extends Command
{
    protected $signature = 'qrcodes:generate-all';
    protected $description = 'Genera y actualiza los códigos QR SEC de todos los socios registrados.';

    public function handle(QrCodeService $qrService): int
    {
        $members = Member::all();
        $this->info("Generando códigos QR para {$members->count()} socios...");

        $count = 0;
        foreach ($members as $member) {
            $path = $qrService->generateSecQrCode($member);
            $this->line("✓ Socio: {$member->full_name} -> {$path}");
            $count++;
        }

        $this->info("¡Completado exitosamente! {$count} códigos QR generados.");
        return Command::SUCCESS;
    }
}
