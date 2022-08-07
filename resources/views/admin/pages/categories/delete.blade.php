<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm " data-bs-toggle="modal"
    data-bs-target="#delete{{ $cate->id }}">
    <i class="bi bi-trash-fill"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="delete{{ $cate->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" class="modal fade" id="create_category"
    tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $cate->slug }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.categories.dalete', $cate->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <img class="img-thumbnail" height="200px" width="200px" src="{{ $cate->PictureCategory }}">

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
