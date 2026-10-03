<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true" data-whatsapp="{{ $site->whatsappNumber() }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="productModalImage" class="img-fluid rounded" alt="Product Image"
                            style="max-height: 400px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <h4 id="productModalName" style="color: #003366;"></h4>
                        <p class="text-muted" id="productModalCategory"></p>
                        <p id="productModalDescription"></p>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="#" id="whatsappInquiry" class="btn btn-success">
                                <i class="fab fa-whatsapp"></i> Contact for Price
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
