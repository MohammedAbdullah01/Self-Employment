<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
    data-bs-target="#comment{{ $project->id }}">
    Comment On Project
</button>

<!-- Modal -->
<div class="modal fade" id="comment{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('user.comment.store' , $project->id)}}" method="post">
                @csrf
                @method('POST')
            <div class="modal-header">
                <h5 class="modal-title text-success" id="staticBackdropLabel">Comment Create
                </h5>
                <button type="button" class="btn-close btn btn-outline-dark btn-sm " data-bs-dismiss="modal"
                    aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <x-form.input-lable-error type="hidden" name="project_id" value="{{$project->id}}" />
                    <div class="form-group col-md-12">
                        <x-form.textarea-lable-error lable="Comment" name="comment" rows="9"
                            placeholder="Enter A Detailed Description On Your Submission To The Project" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary btn-sm">Send</button>
            </div>
        </form>
        </div>
    </div>
</div>
