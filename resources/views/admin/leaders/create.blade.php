@extends('layouts.admin')

@section('title', 'Add Leader - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Add New Leader</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.leaders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.leaders._form')
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.leaders.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
