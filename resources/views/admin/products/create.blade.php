@extends('layouts.admin')

@section('title', 'Add Product - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Add New Product</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.products._form')
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
