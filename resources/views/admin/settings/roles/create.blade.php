@extends('layouts.admin')

@section('title', 'Add Role - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>Add New Role</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                @include('admin.settings.roles._form')
                <button type="submit" class="btn btn-primary">Save Role</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
