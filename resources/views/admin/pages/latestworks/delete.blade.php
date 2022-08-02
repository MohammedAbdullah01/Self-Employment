<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
    data-bs-target="#deleteLatestWork{{ $work->id }}">
    <i class="bi bi-trash-fill"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteLatestWork{{ $work->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3 mb-2 bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $work->title }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=" {{ route('admin.latestwork.delete', $work->id) }} " method="post">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <div class="text-center" style="margin-top:8px">
                            <img class="img-thumbnail"
                                src="{{ $work->pictureLatestWorks }}"
                                alt="{{ $work->main_photo }}" width="200px" height="100px">
                        </div>
                        <div class="modal-body text-danger text-center">
                            {{ __('Are You Sure You Want To Delete [ ' . $work->title . ' ] Work?') }}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Delete') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
