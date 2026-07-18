@extends('layouts.admin')

@section('title', 'Messages - Admin')

@section('content')
    @include('admin.partials.stat-cards')

    <div class="card mb-3 no-print">
        <div class="card-body">
            <form method="GET" class="row gy-2 gx-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Name, email, subject..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-funnel"></i> Apply</button>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <strong>Contact Messages</strong>
            @include('admin.partials.export-buttons', ['exportRouteName' => 'admin.messages.export'])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $index => $message)
                            <tr class="{{ $message->read_at ? '' : 'fw-bold' }}">
                                <td>{{ $messages->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge {{ $message->read_at ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $message->read_at ? 'Read' : 'New' }}
                                    </span>
                                </td>
                                <td><a href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a></td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject ?: '(no subject)' }}</td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No messages found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="no-print">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
