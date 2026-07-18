<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactMessage;
use App\Models\Leader;
use App\Models\PageView;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $counts = [
            'products' => Product::count(),
            'featured' => Product::where('is_featured', true)->count(),
            'categories' => ProductCategory::count(),
            'leaders' => Leader::count(),
            'messages' => ContactMessage::whereNull('read_at')->count(),
            'visitors_today' => PageView::whereDate('created_at', today())->count(),
            'reports' => ActivityLog::whereDate('created_at', today())->count(),
        ];

        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('counts', 'latestMessages'));
    }
}
