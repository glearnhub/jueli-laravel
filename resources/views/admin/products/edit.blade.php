@extends('layouts.admin')

@section('title', 'Edit Product - Admin')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Edit Product</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.products._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
