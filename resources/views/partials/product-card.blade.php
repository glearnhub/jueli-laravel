@php
    $imagePath = $product->product_picture ? asset('storage/' . $product->product_picture) : asset('img/favicon.png');
@endphp
<div class="card product-card h-100">
    <div class="product-img">
        <img src="{{ $imagePath }}" alt="{{ $product->product_name }}" loading="lazy">
    </div>
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $product->product_name }}</h5>
        <p class="card-text mb-1"><small class="text-muted">{{ $product->category?->category_name }}</small></p>
        <p class="card-text">{{ Str::limit($product->product_description, 100, '...') ?: 'No description available' }}</p>
        <button type="button" class="btn btn-primary view-details mt-auto align-self-start" data-bs-toggle="modal"
            data-bs-target="#productModal" data-name="{{ $product->product_name }}"
            data-description="{{ $product->product_description ?? 'No description available' }}"
            data-image="{{ $imagePath }}" data-category="{{ $product->category?->category_name }}">
            View Details
        </button>
    </div>
</div>
