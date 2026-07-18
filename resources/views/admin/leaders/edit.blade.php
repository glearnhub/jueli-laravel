@extends('layouts.admin')

@section('title', 'Edit Leader - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Edit Leader</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.leaders.update', $leader) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.leaders._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.leaders.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
