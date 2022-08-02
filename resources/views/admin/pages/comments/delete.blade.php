<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm " data-bs-toggle="modal"
    data-bs-target="#delete_comment{{ $comment->id }}">
    {{ __('Delate') }}
</button>

<!-- Modal -->
<div class="modal fade" id="delete_comment{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" class="modal fade" id="create_category"
    tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ 'Comment'}}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.comment.delete', $comment->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                        <p class="card-title">{{ $comment->comment }}</p>
                        <p class="text-center font-weight-bold text-danger">
                            {{ __('Are You Sure You Want To Delete Comment ?') }}
                        </p>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-dark btn-sm"
                            data-bs-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ 'Delete' }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
