@extends('layouts.admin')

@section('title', 'Edit Service - Admin')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header"><strong>Edit Service</strong></div>
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.services._form')
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
