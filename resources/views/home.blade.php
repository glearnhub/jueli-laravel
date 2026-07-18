@extends('layouts.app')

@section('title', 'Jueli Engineering Ltd')

@section('content')
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
                            <div class="category-card">
                                <div class="category-img">
                                    <img src="{{ $category->picture ? asset('storage/' . $category->picture) : asset('img/logo_2.png') }}"
                                        alt="{{ $category->category_name }}">
                                </div>
                                <h3>{{ $category->category_name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="slider-nav">
                    <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
                </div>
            @endif
        </div>
    </section>
@endsection
