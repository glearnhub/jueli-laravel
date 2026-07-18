<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    use ExportsCsv;

    public function index(): View
    {
        $messages = $this->filteredQuery()->paginate(15)->withQueryString();

        $stats = [
            ['value' => ContactMessage::count(), 'label' => 'Total Messages'],
            ['value' => ContactMessage::whereNull('read_at')->count(), 'label' => 'Unread'],
            ['value' => ContactMessage::whereNotNull('read_at')->count(), 'label' => 'Read'],
        ];

        return view('admin.messages.index', compact('messages', 'stats'));
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function export()
    {
        $messages = $this->filteredQuery()->get();

        $headings = ['#', 'Name', 'Email', 'Subject', 'Message', 'Received', 'Status'];
        $rows = [];

        foreach ($messages as $index => $message) {
            $rows[] = [
                $index + 1,
                $message->name,
                $message->email,
                $message->subject,
                $message->message,
                $message->created_at->format('Y-m-d H:i'),
                $message->read_at ? 'Read' : 'Unread',
            ];
        }

        return $this->respondWithExport($headings, $rows, 'Messages Report', 'messages');
    }

    private function filteredQuery(): Builder
    {
        return ContactMessage::query()
            ->when(request('search'), fn ($query, $search) => $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('subject', 'like', "%{$search}%")))
            ->latest();
    }
}
