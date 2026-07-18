@extends('layouts.admin')

@section('title', 'Edit User - Admin')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header"><strong>Edit User</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.settings.users._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
