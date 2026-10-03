<section class="hero-section"
    @if ($hero->image_url) style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $hero->image_url }}');" @endif>
    <div class="container">
        {{-- Every page needs one h1; keep a hidden one when the editor leaves the banner heading empty. --}}
        @if ($hero->title)
            <h1 class="display-4 fw-bold">{{ $hero->title }}</h1>
        @else
            <h1 class="visually-hidden">{{ $fallbackTitle ?? 'Jueli Engineering Ltd' }}</h1>
        @endif
        @if ($hero->description)
            <p class="lead">{{ $hero->description }}</p>
        @endif
    </div>
</section>
