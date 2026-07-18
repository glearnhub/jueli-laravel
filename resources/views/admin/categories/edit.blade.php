@extends('layouts.admin')

@section('title', 'Edit Category - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Edit Category</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.categories._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
