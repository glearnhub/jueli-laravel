@extends('layouts.admin')

@section('title', 'Edit Hero Slide - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>Edit Hero Slide</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.hero-slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.hero-slides._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
