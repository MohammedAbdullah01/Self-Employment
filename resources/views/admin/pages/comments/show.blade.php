<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
    data-bs-target="#show_comment{{ $comment->id }}">
    <i class="bi bi-eye-fill"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="show_comment{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ $comment->user->PictureFreelancer }}" width="70" height="70" alt="Profile" class="rounded-circle">
                <h5 class="modal-title m-3" id="staticBackdropLabel">{{ $comment->user->name }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->project->title }}</h5><hr>
                        <p class="card-text">{{ $comment->comment }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark btn-sm"
                    data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
