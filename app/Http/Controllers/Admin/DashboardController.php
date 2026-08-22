<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Faq;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('is_active', true)->count();
        $totalCertificates = Certificate::count();
        $totalFaqs = Faq::count();

        $recentMembers = Member::with('certificates')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'activeMembers',
            'totalCertificates',
            'totalFaqs',
            'recentMembers'
        ));
    }
}
