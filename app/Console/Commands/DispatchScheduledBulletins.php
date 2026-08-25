<?php

namespace App\Console\Commands;

use App\Models\Bulletin;
use App\Models\ContentGrid;
use App\Services\AiBulletinService;
use App\Services\BulletinDispatcherService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DispatchScheduledBulletins extends Command
{
    protected $signature = 'bulletins:dispatch-scheduled';
    protected $description = 'Procesa y despacha automáticamente los boletines y contenidos programados en fecha y hora (Chile)';

    public function handle(BulletinDispatcherService $dispatcher, AiBulletinService $aiService): int
    {
        $now = Carbon::now('America/Santiago');
        $this->info("Verificando contenidos programados a las {$now->format('Y-m-d H:i:s')} (Hora Chile)...");

        $dispatchedCount = 0;

        // 1. Dispatch pre-scheduled bulletins
        $scheduledBulletins = Bulletin::where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', $now)
            ->get();

        foreach ($scheduledBulletins as $bulletin) {
            $this->info("Despachando boletín ID {$bulletin->id}: '{$bulletin->title}'");
            
            // Prepare sends
            $dispatcher->prepareSends($bulletin);

            // Process all sends in batches
            do {
                $batch = $dispatcher->processBatch($bulletin, 10);
            } while ($batch['remaining'] > 0);

            $bulletin->update([
                'status' => 'sent',
                'sent_at' => $now,
            ]);

            // Update linked grid item if exists
            ContentGrid::where('bulletin_id', $bulletin->id)->update([
                'status' => 'sent',
            ]);

            $dispatchedCount++;
        }

        // 2. Dispatch scheduled content grid items that need AI generation on-the-fly
        $scheduledGridItems = ContentGrid::where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', $now)
            ->get();

        foreach ($scheduledGridItems as $item) {
            if ($item->bulletin && in_array($item->bulletin->status, ['sent', 'sending'])) {
                $item->update(['status' => 'sent']);
                continue;
            }

            $this->info("Generando y despachando tema de la grilla: '{$item->topic}'");

            try {
                $generated = $aiService->generateBulletin($item->topic, $item->category);

                $bulletin = Bulletin::create([
                    'title' => $generated['title'],
                    'subject' => $generated['subject'],
                    'category' => $item->category,
                    'content_html' => $generated['content_html'],
                    'status' => 'sending',
                    'scheduled_at' => $item->scheduled_at,
                ]);

                $item->update([
                    'bulletin_id' => $bulletin->id,
                ]);

                $dispatcher->prepareSends($bulletin);

                do {
                    $batch = $dispatcher->processBatch($bulletin, 10);
                } while ($batch['remaining'] > 0);

                $bulletin->update([
                    'status' => 'sent',
                    'sent_at' => $now,
                ]);

                $item->update(['status' => 'sent']);
                $dispatchedCount++;
            } catch (\Exception $e) {
                Log::error("Error despachando tema de grilla programado ({$item->id}): " . $e->getMessage());
                $this->error("Error en tema {$item->id}: " . $e->getMessage());
            }
        }

        $this->info("Proceso completado. Total boletines/contenidos despachados: {$dispatchedCount}");
        return Command::SUCCESS;
    }
}
