<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-col">
                <h3>JUELI ENGINEERING LTD</h3>
                <p>Engineering Solutions for a Sustainable Future. Providing innovative, cost-efficient, and
                    high-quality engineering services across multiple sectors.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
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
                    <li><a href="{{ route('services') }}">Mechanical Services</a></li>
                    <li><a href="{{ route('services') }}">Steel Fabrication</a></li>
                    <li><a href="{{ route('services') }}">HVAC Systems</a></li>
                    <li><a href="{{ route('services') }}">Plumbing & Piping</a></li>
                    <li><a href="{{ route('services') }}">Lift Installation</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Info</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Nairobi Industrial Area, Kenya</li>
                    <li><i class="fas fa-phone-alt"></i> +254 704 553 400</li>
                    <li><i class="fas fa-envelope"></i> info@jueliengineeringltd.co.ke</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ now()->year }} JUELI ENGINEERING LTD. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING%20LTD,%20I%20have%20an%20inquiry%20about%20your%20products"
    class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp fa-lg"></i>
</a>
