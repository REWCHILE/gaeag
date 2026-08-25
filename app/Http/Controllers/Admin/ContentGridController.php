<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\ContentGrid;
use App\Services\AiBulletinService;
use App\Services\BulletinDispatcherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ContentGridController extends Controller
{
    public function index()
    {
        $gridItems = ContentGrid::with('bulletin')
            ->orderByRaw("COALESCE(scheduled_at, scheduled_date) ASC")
            ->get();

        $currentTimeChile = Carbon::now('America/Santiago')->format('d/m/Y H:i:s');

        return view('admin.content_grid.index', compact('gridItems', 'currentTimeChile'));
    }

    public function generateGrid(Request $request, AiBulletinService $aiService)
    {
        $validated = $request->validate([
            'frequency' => 'required|in:semanal,mensual',
        ]);

        $generatedItems = $aiService->generateContentGrid($validated['frequency']);

        foreach ($generatedItems as $item) {
            // Default scheduled hour: 09:00 Chile
            $dateStr = $item['scheduled_date'];
            $item['scheduled_at'] = Carbon::parse("{$dateStr} 09:00:00", 'America/Santiago');
            $item['status'] = 'planned';
            ContentGrid::create($item);
        }

        return redirect()->route('admin.content_grid.index')
            ->with('success', "Grilla de contenidos '{$validated['frequency']}' generada exitosamente con Inteligencia Artificial.");
    }

    public function schedule(Request $request, ContentGrid $item)
    {
        $validated = $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|string',
        ]);

        $dateTime = Carbon::parse("{$validated['scheduled_date']} {$validated['scheduled_time']}:00", 'America/Santiago');

        $item->update([
            'scheduled_date' => $dateTime->toDateString(),
            'scheduled_at' => $dateTime,
            'status' => 'scheduled',
        ]);

        if ($item->bulletin) {
            $item->bulletin->update([
                'scheduled_at' => $dateTime,
                'status' => 'scheduled',
            ]);
        }

        return redirect()->route('admin.content_grid.index')
            ->with('success', "Tema '{$item->topic}' programado con éxito para el {$dateTime->format('d/m/Y \a \l\a\s H:i')} (Hora de Chile). El cron lo despachará automáticamente.");
    }

    public function convertToBulletin(ContentGrid $item, AiBulletinService $aiService)
    {
        $generated = $aiService->generateBulletin($item->topic, $item->category);

        $bulletin = Bulletin::create([
            'title' => $generated['title'],
            'subject' => $generated['subject'],
            'category' => $item->category,
            'content_html' => $generated['content_html'],
            'status' => 'draft',
            'scheduled_at' => $item->scheduled_at,
        ]);

        $item->update([
            'status' => 'generated',
            'bulletin_id' => $bulletin->id,
        ]);

        return redirect()->route('admin.bulletins.show', $bulletin)
            ->with('success', "Tema '{$item->topic}' convertido en boletín listo para revisar o enviar.");
    }

    public function runCronNow()
    {
        Artisan::call('bulletins:dispatch-scheduled');
        $output = Artisan::output();

        return redirect()->route('admin.content_grid.index')
            ->with('success', "Ejecución manual de Cron completada exitosamente. " . trim($output));
    }

    public function destroy(ContentGrid $item)
    {
        $item->delete();

        return redirect()->route('admin.content_grid.index')
            ->with('success', 'Tema eliminado de la grilla de contenidos.');
    }
}
