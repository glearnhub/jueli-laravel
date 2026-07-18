@extends('layouts.app')

@section('title', 'Shop - Jueli Engineering Ltd')

@push('styles')
    <style>
        .hero-section {
            height: 40vh;
            min-height: 250px;
            display: flex;
            align-items: center;
            background: url('{{ asset('img/bg_2.jpg') }}') center/cover no-repeat;
            color: white;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <section class="hero-section"></section>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $currentCategoryId ? $categories->firstWhere('id', (int) $currentCategoryId)?->category_name ?? 'All Products' : 'All Products' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <li>
                            <a class="dropdown-item {{ ! $currentCategoryId ? 'active' : '' }}" href="{{ route('shop') }}">All
                                Products</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item {{ (int) $currentCategoryId === $category->id ? 'active' : '' }}"
                                    href="{{ route('shop', ['category' => $category->id]) }}">
                                    {{ $category->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row" id="products-container">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="product-img"
                            style="height: 150px; overflow: hidden; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                            @php
                                $imagePath = $product->product_picture ? asset('storage/' . $product->product_picture) : asset('img/logo_2.png');
                            @endphp
                            <img src="{{ $imagePath }}" class="img-fluid" alt="{{ $product->product_name }}"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="color: #003366;">{{ $product->product_name }}</h5>
                            <p class="card-text"><small class="text-muted">{{ $product->category?->category_name }}</small></p>
                            <p class="card-text">{{ Str::limit($product->product_description, 100, '...') ?: 'No description available' }}</p>
                            <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#productModal"
                                data-name="{{ $product->product_name }}"
                                data-description="{{ $product->product_description ?? 'No description available' }}"
                                data-image="{{ $imagePath }}"
                                data-category="{{ $product->category?->category_name }}">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found in this category.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" id="productModalImage" class="img-fluid rounded" alt="Product Image"
                                style="max-height: 400px; object-fit: contain;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="productModalName" style="color: #003366;"></h4>
                            <p class="text-muted" id="productModalCategory"></p>
                            <p id="productModalDescription"></p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="#" id="whatsappInquiry" class="btn btn-success">
                                    <i class="fab fa-whatsapp"></i> Contact for Price
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
