@if (session()->has('error'))
    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session()->get('error') }}</p>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@elseif(session()->has('success'))
    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Success...
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session()->get('success') }}</p>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif
