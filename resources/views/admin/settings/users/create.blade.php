@extends('layouts.admin')

@section('title', 'Add User - Admin')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header"><strong>Add New User</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                @include('admin.settings.users._form')
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
