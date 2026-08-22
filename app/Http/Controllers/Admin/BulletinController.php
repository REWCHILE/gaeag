<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\BulletinSend;
use App\Models\Member;
use App\Services\AiBulletinService;
use App\Services\BulletinDispatcherService;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::with('sends')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $totalBulletins = Bulletin::count();
        $totalSentEmails = BulletinSend::where('status', 'sent')->count();
        $activeMembersWithEmail = Member::where('is_active', true)->whereNotNull('email')->count();

        return view('admin.bulletins.index', compact(
            'bulletins',
            'totalBulletins',
            'totalSentEmails',
            'activeMembersWithEmail'
        ));
    }

    public function create()
    {
        return view('admin.bulletins.create');
    }

    public function generateAi(Request $request, AiBulletinService $aiService)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'category' => 'required|string|max:100',
        ]);

        $generated = $aiService->generateBulletin($validated['topic'], $validated['category']);

        return response()->json([
            'success' => true,
            'title' => $generated['title'],
            'subject' => $generated['subject'],
            'content_html' => $generated['content_html'],
        ]);
    }

    public function store(Request $request, BulletinDispatcherService $dispatcher)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content_html' => 'required|string',
            'action' => 'required|in:save_draft,start_send',
        ]);

        $bulletin = Bulletin::create([
            'title' => $validated['title'],
            'subject' => $validated['subject'],
            'category' => $validated['category'],
            'content_html' => $validated['content_html'],
            'status' => 'draft',
        ]);

        if ($validated['action'] === 'start_send') {
            $dispatcher->prepareSends($bulletin);
            $dispatcher->processBatch($bulletin, 10);
            return redirect()->route('admin.bulletins.show', $bulletin)
                ->with('success', 'Boletín creado y cola de envío masivo iniciada correctamente.');
        }

        return redirect()->route('admin.bulletins.show', $bulletin)
            ->with('success', 'Boletín guardado como borrador.');
    }

    public function show(Bulletin $bulletin)
    {
        $bulletin->load(['sends.member']);
        $sends = $bulletin->sends()->with('member')->paginate(15);

        return view('admin.bulletins.show', compact('bulletin', 'sends'));
    }

    public function processSends(Bulletin $bulletin, BulletinDispatcherService $dispatcher)
    {
        $result = $dispatcher->processBatch($bulletin, 5);

        return redirect()->route('admin.bulletins.show', $bulletin)
            ->with('success', "Procesado lote de envíos. Procesados: {$result['processed']}, Restantes: {$result['remaining']}.");
    }

    public function destroy(Bulletin $bulletin)
    {
        $title = $bulletin->title;
        $bulletin->delete();

        return redirect()->route('admin.bulletins.index')
            ->with('success', "Boletín '{$title}' eliminado del sistema.");
    }
}
