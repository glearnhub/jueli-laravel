@extends('layouts.admin')

@section('title', 'Edit Role - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>Edit Role</strong></div>
        <div class="card-body">
            @if ($role->slug === 'super-admin')
                <div class="alert alert-info">The Super Admin role always has every permission and cannot be edited.</div>
            @endif
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.settings.roles._form')
                @if ($role->slug !== 'super-admin')
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                @endif
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
