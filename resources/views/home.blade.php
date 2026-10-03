@extends('layouts.app')

@section('title', 'Jueli Engineering Ltd')
@section('meta_description', 'Jueli Engineering Ltd offers mechanical engineering, steel fabrication, HVAC, plumbing and welding services, plus tools and hardware supplies, in Nairobi, Kenya.')

@section('content')
    <h1 class="visually-hidden">Jueli Engineering Ltd - engineering products and services in Nairobi, Kenya</h1>

    <section class="hero-slider">
        <div class="slide active" style="background-image: url('{{ asset('img/bg_2.jpg') }}');">
            <div class="slide-content">
                <h2>Our Vision</h2>
                <p>Delivering high-quality mechanical services and steel fabrication for industrial and commercial
                    projects.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('{{ asset('img/bg_1.jpg') }}');">
            <div class="slide-content">
                <h2>Mission Statement</h2>
                <p>To offer exceptional, innovative, and dependable engineering services.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('{{ asset('img/bg_3.jpg') }}');">
            <div class="slide-content">
                <h2>Core Values</h2>
                <p>Integrity, Excellence, Innovation, Customer Centricity.</p>
            </div>
        </div>
    </section>

    <section class="category-slider-section" id="categorySlider">
        <div class="container">
            <h2 class="section-title">Our Product Categories</h2>

            @if ($categories->isEmpty())
                <div class="notice">No product categories found.</div>
            @else
                <div class="category-slider">
                    @foreach ($categories as $category)
                        <div class="category-slide">
                            <a class="category-card" href="{{ route('shop', ['category' => $category->id]) }}"
                                aria-label="Browse {{ $category->category_name }} products">
                                <div class="category-img">
                                    <img src="{{ $category->picture ? asset('storage/' . $category->picture) : asset('img/favicon.png') }}"
                                        alt="{{ $category->category_name }}" loading="lazy">
                                </div>
                                <h3>{{ $category->category_name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="slider-nav">
                    <button type="button" class="slider-prev" aria-label="Previous categories"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="slider-next" aria-label="Next categories"><i class="fas fa-chevron-right"></i></button>
                </div>
            @endif
        </div>
    </section>

    <section class="featured-products-section" id="featured">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>

            @if ($featuredProducts->isEmpty())
                <div class="notice">No featured products yet.</div>
            @else
                <div class="row">
                    @foreach ($featuredProducts as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('shop') }}" class="btn btn-primary">View all products</a>
                </div>
            @endif
        </div>
    </section>

    @include('partials.product-modal')
@endsection
