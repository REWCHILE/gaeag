<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\ContentGrid;
use App\Services\AiBulletinService;
use App\Services\BulletinDispatcherService;
use Illuminate\Http\Request;

class ContentGridController extends Controller
{
    public function index()
    {
        $gridItems = ContentGrid::with('bulletin')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return view('admin.content_grid.index', compact('gridItems'));
    }

    public function generateGrid(Request $request, AiBulletinService $aiService)
    {
        $validated = $request->validate([
            'frequency' => 'required|in:semanal,mensual',
        ]);

        $generatedItems = $aiService->generateContentGrid($validated['frequency']);

        foreach ($generatedItems as $item) {
            ContentGrid::create($item);
        }

        return redirect()->route('admin.content_grid.index')
            ->with('success', "Grilla de contenidos '{$validated['frequency']}' generada exitosamente con Inteligencia Artificial.");
    }

    public function convertToBulletin(ContentGrid $item, AiBulletinService $aiService, BulletinDispatcherService $dispatcher)
    {
        $generated = $aiService->generateBulletin($item->topic, $item->category);

        $bulletin = Bulletin::create([
            'title' => $generated['title'],
            'subject' => $generated['subject'],
            'category' => $item->category,
            'content_html' => $generated['content_html'],
            'status' => 'draft',
        ]);

        $item->update([
            'status' => 'generated',
            'bulletin_id' => $bulletin->id,
        ]);

        return redirect()->route('admin.bulletins.show', $bulletin)
            ->with('success', "Tema '{$item->topic}' convertido en boletín listo para revisar o enviar.");
    }

    public function destroy(ContentGrid $item)
    {
        $item->delete();

        return redirect()->route('admin.content_grid.index')
            ->with('success', 'Tema eliminado de la grilla de contenidos.');
    }
}
