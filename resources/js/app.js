import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    initHeroSlider();
    initHorizontalSliders();
    initProductModal();
});

function initHeroSlider() {
    const heroSlider = document.querySelector('.hero-slider');
    if (!heroSlider) return;

    const slides = heroSlider.querySelectorAll('.slide');
    if (!slides.length) return;

    let currentSlide = 0;

    const navContainer = document.createElement('div');
    navContainer.className = 'slider-nav';
    heroSlider.appendChild(navContainer);

    slides.forEach((slide, index) => {
        const dot = document.createElement('button');
        dot.addEventListener('click', () => goToSlide(index));
        navContainer.appendChild(dot);
    });

    const dots = navContainer.querySelectorAll('button');

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide]?.classList.remove('active');
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        dots[currentSlide]?.classList.add('active');
    }

    let slideInterval = setInterval(() => goToSlide(currentSlide + 1), 5000);
    goToSlide(0);

    heroSlider.addEventListener('mouseenter', () => clearInterval(slideInterval));
    heroSlider.addEventListener('mouseleave', () => {
        slideInterval = setInterval(() => goToSlide(currentSlide + 1), 5000);
    });
}

function initHorizontalSliders() {
    const sliders = [
        {
            slider: document.querySelector('.category-slider'),
            prevBtn: document.querySelector('#categorySlider .slider-prev'),
            nextBtn: document.querySelector('#categorySlider .slider-next'),
        },
        {
            slider: document.querySelector('.services-slider'),
            prevBtn: document.querySelector('.services-slider-section .slider-prev'),
            nextBtn: document.querySelector('.services-slider-section .slider-next'),
        },
    ];

    sliders.forEach(({ slider, prevBtn, nextBtn }) => {
        if (!slider || !prevBtn || !nextBtn) return;

        const firstSlide = slider.querySelector('.category-slide') || slider.querySelector('.services-slide');
        const slideWidth = firstSlide ? firstSlide.offsetWidth + 20 : 300;

        function updateButtons() {
            prevBtn.classList.toggle('disabled', slider.scrollLeft <= 10);
            nextBtn.classList.toggle('disabled', slider.scrollLeft >= slider.scrollWidth - slider.clientWidth - 10);
        }

        function scrollToPosition(position) {
            slider.scrollTo({ left: position, behavior: 'smooth' });
        }

        prevBtn.addEventListener('click', () => {
            scrollToPosition(Math.max(slider.scrollLeft - slideWidth * 3, 0));
        });

        nextBtn.addEventListener('click', () => {
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            scrollToPosition(Math.min(slider.scrollLeft + slideWidth * 3, maxScroll));
        });

        slider.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);
        updateButtons();
    });
}

function initProductModal() {
    const productModal = document.getElementById('productModal');
    if (!productModal) return;

    productModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const image = button.getAttribute('data-image');
        const category = button.getAttribute('data-category');

        document.getElementById('productModalTitle').textContent = name;
        document.getElementById('productModalName').textContent = name;
        document.getElementById('productModalCategory').textContent = category;
        document.getElementById('productModalDescription').textContent = description;
        document.getElementById('productModalImage').src = image;

        const whatsappBtn = document.getElementById('whatsappInquiry');
        const message = `Hello JUELI ENGINEERING, I'm interested in your ${name} (${category}) product. Could you please share the price and details?`;
        whatsappBtn.href = `https://wa.me/254704553400?text=${encodeURIComponent(message)}`;
    });
}
