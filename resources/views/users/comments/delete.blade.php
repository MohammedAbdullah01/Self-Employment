<button class="btn btn-outline-danger btn-sm me-md-2" data-bs-toggle="modal"
    data-bs-target="#comment_delete{{ $comment->pivot->id }}" type="button">
    <i class="ti-trash mr-2"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="comment_delete{{ $comment->pivot->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.comment.delete', $comment->pivot->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel">Comment Delete
                    </h5>
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-dismiss="modal"
                        aria-label="Close"><i class="ti-close"></i> </button>
                </div>
                <div class="modal-body">
                    <p class="card-text">{{ $comment->pivot->comment }}</p>

                    <div class="modal-body text-danger text-center">
                        {{ __('Are You Sure You Want To Delete Comment ?') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
