@extends('layouts.app')

@section('title', 'About Us - Jueli Engineering Ltd')

@section('content')
    @include('partials.page-hero', ['hero' => $hero, 'fallbackTitle' => 'About Us'])

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>Founded in December 2024, JUELI ENGINEERING LTD is based in Nairobi Industrial Area and offers a
                        broad spectrum of engineering services. Our company specializes in mechanical solutions, steel
                        fabrication, HVAC installations, plumbing, welding, lift services, and the supply of engineering
                        materials.</p>
                    <p>We pride ourselves on providing solutions that are efficient, reliable, and tailored to the
                        unique needs of each client. Our goal is to exceed client expectations while ensuring the
                        highest standards of safety, reliability, and performance in all our projects.</p>
                    <p>With a vision to be a premier provider of engineering services in Kenya and internationally, we
                        are committed to excellence in technical capabilities, customer service, and the delivery of
                        innovative solutions.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('img/about_img.jpg') }}" alt="JUELI Engineering Team">
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="team-container">
            <h2 class="section-title">Our Expert Team</h2>

            <div class="team-row text-center">
                @forelse ($leaders as $leader)
                    <div class="team-card">
                        <div class="team-img">
                            <img src="{{ $leader->profile_picture ? asset('storage/' . $leader->profile_picture) : 'https://via.placeholder.com/150' }}"
                                alt="{{ $leader->fullname }}">
                        </div>
                        <div class="team-info">
                            <h3>{{ $leader->fullname }}</h3>
                            <p class="position">{{ $leader->position }}</p>
                        </div>
                    </div>
                @empty
                    <p>No team members found.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
