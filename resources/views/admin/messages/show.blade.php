@extends('layouts.admin')

@section('title', 'Message - Admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{{ $message->subject ?: '(no subject)' }}</strong>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">From</dt>
                <dd class="col-sm-10">{{ $message->name }} &lt;{{ $message->email }}&gt;</dd>

                <dt class="col-sm-2">Received</dt>
                <dd class="col-sm-10">{{ $message->created_at->format('d M Y, H:i') }}</dd>
            </dl>
            <hr>
            <p style="white-space: pre-wrap;">{{ $message->message }}</p>

            <a href="mailto:{{ $message->email }}" class="btn btn-primary">Reply by Email</a>
        </div>
    </div>
@endsection
