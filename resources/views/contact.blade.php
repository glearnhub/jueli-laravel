@extends('layouts.app')

@section('title', 'Contact Us - Jueli Engineering Ltd')
@section('meta_description', 'Contact Jueli Engineering Ltd in Nairobi Industrial Area for quotes, product enquiries and engineering services.')

@section('content')
    @include('partials.page-hero', ['hero' => $hero, 'fallbackTitle' => 'Contact Us'])

    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <p><strong>Address:</strong></p>
                                <p>{{ $site->address() }}</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <p><strong>Phone:</strong></p>
                                <p>{{ $site->phone() }}</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <p><strong>Email:</strong></p>
                                <p>{{ $site->email() }}</p>
                                <p>eliud@juelienginerring.co.ke</p>
                                <p>judy@jueliengineering.co.ke</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p><strong>Working Hours:</strong></p>
                                <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                                <p>Saturday: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Send Us a Message</h3>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Your Name" aria-label="Your name" autocomplete="name" maxlength="255" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Your Email" aria-label="Your email" autocomplete="email" maxlength="255" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror

                        <input type="text" name="subject" placeholder="Subject" aria-label="Subject" maxlength="255" value="{{ old('subject') }}">

                        <textarea name="message" placeholder="Your Message" aria-label="Your message" maxlength="5000" required>{{ old('message') }}</textarea>
                        @error('message')
                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                        @enderror

                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
