<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-info btn-sm me-md-2" data-bs-toggle="modal"
    data-bs-target="#show_gallery{{ $work->id }}">
    <i class="ti-eye"></i>
</button>


<div class="modal fade" id="show_gallery{{ $work->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="staticBackdropLabel">{{ 'Project Description' }}</h5>
                <button type="button" class="btn btn-light " data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>

            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $work->description }}</h5>
            </div>
            <div class="modal-body">


                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @forelse ($work->photos as $photo)
                        <div class="col">
                            <div class="card mb-3">
                                <img src="{{ asset('storage/users/latestwork/' . $photo->sub_images) }}" class="img-thumbnail " style="height: 300px">
                            </div>
                        </div>
                    @empty
                        <h5 class="card-title text-danger">
                            <b>{{ 'There Are No Uploaded Files !' }}</b>
                        </h5>
                    @endforelse
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
