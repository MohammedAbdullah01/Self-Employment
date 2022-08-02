<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
    data-bs-target="#show_category{{ $cate->id }}">
    {{ __('Show') }}
</button>

<!-- Modal -->
<div class="modal fade" id="show_category{{ $cate->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $cate->name }}</h5>
                <button type="button" class="btn-close btn-light btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="img-thumbnail" height="100px" width="100%" src="{{ $cate->PictureCategory }}">
                    <div class="card-body">
                        <p class="card-text">{{ $cate->description }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm"
                    data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
