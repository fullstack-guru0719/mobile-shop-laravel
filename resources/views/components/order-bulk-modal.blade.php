<div class="modal fade" id="{{ $modalId }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ $formAction }}" method="POST" id="{{ $formId }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $modalTitle }}</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method("PATCH")
                    <h6>{{ $message }} <strong>{{ $status }}</strong></h6>
                    <span class="text-danger">NOTE: This cannot be undone</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Cancel
                    </button>
                    <button class="btn btn-success" type="submit" id="button-complete-submit">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>