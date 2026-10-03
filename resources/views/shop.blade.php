@extends('layouts.app')

@section('title', ($currentCategoryId ? $categories->firstWhere('id', $currentCategoryId)?->category_name.' - ' : '').'Shop - Jueli Engineering Ltd')
@section('meta_description', 'Browse tools, hardware, plumbing, electrical and building supplies'.($currentCategoryId ? ' in '.$categories->firstWhere('id', $currentCategoryId)?->category_name : '').' from Jueli Engineering Ltd, Nairobi.')
@section('canonical', url()->full())

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
    <section class="hero-section">
        <div class="container"><h1 class="visually-hidden">Shop - Jueli Engineering Ltd products</h1></div>
    </section>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $currentCategoryId ? $categories->firstWhere('id', (int) $currentCategoryId)?->category_name ?? 'All Products' : 'All Products' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown" style="max-height: 60vh; overflow-y: auto;">
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
            <div class="col-md-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                <p class="text-muted mb-0">
                    @if ($products->total())
                        Showing {{ $products->firstItem() }}&ndash;{{ $products->lastItem() }} of {{ $products->total() }}
                        {{ Str::plural('product', $products->total()) }}
                        @if ($currentCategoryId)
                            in <strong>{{ $categories->firstWhere('id', $currentCategoryId)?->category_name }}</strong>
                        @endif
                    @endif
                </p>
            </div>
        </div>

        <div class="row" id="products-container">
            @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    @include('partials.product-card', ['product' => $product])
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

    @include('partials.product-modal')
@endsection
