<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
    data-bs-target="#delete{{ $project->id }}">
    <i class="ti-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="delete{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $project->title }}</h5>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                    aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <form action=" {{ route('client.delete.project', $project) }} " method="post">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <div class="modal-body text-danger text-center">
                            {{ __('Are You Sure You Want To Delete [ ' . $project->title . ' ] project?') }}
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
