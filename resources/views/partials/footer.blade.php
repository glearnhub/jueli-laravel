<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-col">
                <a href="{{ route('home') }}" class="footer-logo" aria-label="Jueli Engineering Ltd - Home">
                    <img src="{{ asset('img/logo.png') }}" alt="Jueli Engineering Ltd" width="484" height="197">
                </a>
                <p>Engineering Solutions for a Sustainable Future. Providing innovative, cost-efficient, and
                    high-quality engineering services across multiple sectors.</p>
                @if ($socialLinks = $site->socialLinks())
                    <div class="social-links">
                        @foreach ($socialLinks as $link)
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link['label'] }}"><i class="{{ $link['icon'] }}"></i></a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services') }}">Our Services</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Our Services</h3>
                <ul>
                    @forelse ($footerServices as $footerService)
                        <li><a href="{{ route('services.show', $footerService) }}">{{ $footerService->title }}</a></li>
                    @empty
                        <li><a href="{{ route('services') }}">View all services</a></li>
                    @endforelse
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Info</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> {{ $site->address() }}</li>
                    <li><i class="fas fa-phone-alt"></i> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone()) }}">{{ $site->phone() }}</a></li>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $site->email() }}">{{ $site->email() }}</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ now()->year }} {{ strtoupper($site->name()) }}. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<a href="{{ $site->whatsappUrl('Hello JUELI ENGINEERING LTD, I have an inquiry about your products') }}"
    class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>
