@extends('layouts.app')

@section('title', 'Our Services - Jueli Engineering Ltd')
@section('meta_description', 'Mechanical services, steel fabrication, HVAC, plumbing, welding and lift services from Jueli Engineering Ltd in Nairobi.')

@push('styles')
    <style>
        .services-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .service-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-img {
            height: 200px;
            overflow: hidden;
        }

        .service-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .service-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .service-more {
            margin-top: auto;
            padding-top: 16px;
        }

        .service-more .btn {
            padding: 8px 18px;
            font-size: 14px;
            text-decoration: none;
        }

        .service-info h3 {
            color: #003366;
            margin-bottom: 10px;
        }

        .service-info p {
            color: #666;
            font-size: 14px;
            margin-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <h1 class="visually-hidden">Our Services - Jueli Engineering Ltd</h1>

    @if ($slides->isNotEmpty())
        <section class="hero-slider">
            @foreach ($slides as $slide)
                <div class="slide {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{ $slide->image_url }}');">
                    <div class="slide-content">
                        <h2>{{ $slide->title }}</h2>
                        @if ($slide->description)
                            <p>{{ $slide->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    @endif

    <section class="services-section" id="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>

            @if ($services->isEmpty())
                <p class="text-center text-muted">Our services will be listed here soon.</p>
            @else
                <div class="row g-4">
                    @foreach ($services as $service)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="service-card">
                                @if ($service->image_url)
                                    <div class="service-img">
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}">
                                    </div>
                                @endif
                                <div class="service-info">
                                    <h3>{{ $service->title }}</h3>
                                    <p>{{ $service->description }}</p>
                                    <div class="service-more">
                                        <a href="{{ route('services.show', $service) }}" class="btn">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
