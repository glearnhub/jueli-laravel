@extends('layouts.admin')

@section('title', 'Add Category - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Add New Category</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.categories._form')
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
