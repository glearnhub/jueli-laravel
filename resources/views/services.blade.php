@extends('layouts.app')

@section('title', 'Our Services - Jueli Engineering Ltd')

@push('styles')
    <style>
        .services-slider-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .services-slider {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            gap: 20px;
            padding: 20px 0;
            margin: 0 -15px;
        }

        .services-slide {
            scroll-snap-align: start;
            flex: 0 0 calc(33.333% - 20px);
            min-width: 300px;
            padding: 0 15px;
        }

        .service-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
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
        }

        .service-info h3 {
            color: #003366;
            margin-bottom: 10px;
        }

        .service-info p {
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .services-slide {
                flex: 0 0 calc(50% - 20px);
                min-width: 250px;
            }
        }

        @media (max-width: 576px) {
            .services-slide {
                flex: 0 0 100%;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero-slider">
        <div class="slide active" style="background-image: url('{{ asset('img/steel_tower.jpeg') }}');">
            <div class="slide-content">
                <h2>Our Vision</h2>
                <p>Delivering high-quality mechanical services and steel fabrication for industrial and commercial
                    projects.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('{{ asset('img/bg_2.jpg') }}');">
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

    <section class="services-slider-section" id="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>

            @php
                $services = [
                    ['img' => 'mechanic_service.jpg', 'title' => 'Mechanical Services', 'desc' => 'Design, installation, and ongoing maintenance of mechanical systems for various applications.'],
                    ['img' => 'fabrication.jpg', 'title' => 'Steel Structure Design & Fabrication', 'desc' => 'Providing top-quality steel structures tailored for residential, commercial, and industrial applications.'],
                    ['img' => 'hvac.jpg', 'title' => 'HVAC Systems', 'desc' => 'Delivering energy-efficient heating, ventilation, and air conditioning systems for all building types.'],
                    ['img' => 'plumbing.jpg', 'title' => 'Plumbing & Piping Solutions', 'desc' => 'Comprehensive installation and maintenance of plumbing and piping systems for water, gas, and waste.'],
                    ['img' => 'welding.jpg', 'title' => 'Welding & MIG Fabrication', 'desc' => 'Specializing in precision welding for construction and heavy-duty applications.'],
                    ['img' => 'lift.jpg', 'title' => 'Lift Installation Services', 'desc' => 'Complete lift design, installation, and maintenance for residential and commercial buildings.'],
                ];
            @endphp

            <div class="services-slider">
                @foreach ($services as $service)
                    <div class="services-slide">
                        <div class="service-card">
                            <div class="service-img">
                                <img src="{{ asset('img/' . $service['img']) }}" alt="{{ $service['title'] }}">
                            </div>
                            <div class="service-info">
                                <h3>{{ $service['title'] }}</h3>
                                <p>{{ $service['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="slider-nav">
                <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>
@endsection
