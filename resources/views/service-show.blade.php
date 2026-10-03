@extends('layouts.app')

@section('title', $service->title.' - Jueli Engineering Ltd')
@section('meta_description', Str::limit($service->description, 155))
@section('meta_image', $service->image_url ?: asset('img/logo.png'))

@push('styles')
    <style>
        .hero-compact {
            height: 320px;
            padding: 70px 0;
        }

        .service-detail {
            padding: 60px 0;
        }

        .service-main-img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 12px;
            background: #f1f3f5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .service-thumbs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 12px;
        }

        .service-thumb {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 3px solid transparent;
            opacity: 0.7;
            transition: opacity 0.2s ease, border-color 0.2s ease;
        }

        .service-thumb:hover,
        .service-thumb.active {
            opacity: 1;
            border-color: #FFA500;
        }

        .service-details {
            white-space: pre-line;
            color: #444;
            line-height: 1.8;
        }

        .service-detail h2 {
            color: #003366;
            font-size: 1.6rem;
        }

        .service-actions .btn {
            text-decoration: none;
            margin: 0 8px 8px 0;
        }

        .btn-whatsapp {
            background-color: #25D366;
        }

        .btn-whatsapp:hover {
            background-color: #1da851;
        }

        .other-services {
            padding: 50px 0 70px;
            background-color: #f8f9fa;
        }

        .other-service-card {
            display: block;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .other-service-card:hover {
            transform: translateY(-5px);
        }

        .other-service-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .other-service-card h3 {
            color: #003366;
            font-size: 1.1rem;
            margin: 0;
            padding: 16px;
        }
    </style>
@endpush

@section('content')
    <section class="hero-section hero-compact"
        @if ($service->image_url) style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $service->image_url }}');" @endif>
        <div class="container">
            <h1 class="display-5 fw-bold">{{ $service->title }}</h1>
            <p class="lead">{{ Str::limit($service->description, 160) }}</p>
        </div>
    </section>

    <section class="service-detail">
        <div class="container">
            <p class="mb-4"><a href="{{ route('services') }}"><i class="fas fa-arrow-left me-1"></i> Back to all services</a></p>

            <div class="row g-5">
                @if ($pictures->isNotEmpty())
                    <div class="col-lg-6">
                        <img id="serviceMainImage" src="{{ $pictures->first() }}" alt="{{ $service->title }}" class="service-main-img">

                        @if ($pictures->count() > 1)
                            <div class="service-thumbs">
                                @foreach ($pictures as $picture)
                                    <img src="{{ $picture }}" alt="{{ $service->title }} picture {{ $loop->iteration }}"
                                        class="service-thumb {{ $loop->first ? 'active' : '' }}" data-full="{{ $picture }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <div class="{{ $pictures->isNotEmpty() ? 'col-lg-6' : 'col-12' }}">
                    <h2>About this service</h2>
                    <div class="service-details">{{ $service->details ?: $service->description }}</div>

                    <div class="service-actions mt-4">
                        <a href="{{ route('contact') }}" class="btn"><i class="fas fa-envelope me-1"></i> Request a Quote</a>
                        <a href="{{ $site->whatsappUrl("Hello JUELI ENGINEERING, I'd like to enquire about your {$service->title} service.") }}"
                            class="btn btn-whatsapp" target="_blank" rel="noopener"><i class="fab fa-whatsapp me-1"></i> Chat on WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($others->isNotEmpty())
        <section class="other-services">
            <div class="container">
                <h2 class="section-title" style="margin-top: 0;">Other Services</h2>
                <div class="row g-4">
                    @foreach ($others as $other)
                        <div class="col-12 col-md-4">
                            <a href="{{ route('services.show', $other) }}" class="other-service-card">
                                @if ($other->image_url)
                                    <img src="{{ $other->image_url }}" alt="{{ $other->title }}">
                                @endif
                                <h3>{{ $other->title }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
