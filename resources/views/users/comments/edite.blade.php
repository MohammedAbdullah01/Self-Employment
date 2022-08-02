<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal"
    data-bs-target="#comment_edit{{ $comment->pivot->id }}">
    <i class="ti-slice mr-2"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="comment_edit{{ $comment->pivot->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.comment.update', $comment->pivot->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="staticBackdropLabel">Comment Edite
                    </h5>
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-dismiss="modal"
                        aria-label="Close"><i class="ti-close"></i> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <x-form.input-lable-error type="hidden" name="project_id" value="{{ $comment->id }}" />
                        <div class="form-group col-md-12">
                            <x-form.textarea-lable-error lable="Comment" :value="$comment->pivot->comment" name="comment" rows="9"
                                placeholder="Enter A Detailed Description On Your Submission To The Project" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
