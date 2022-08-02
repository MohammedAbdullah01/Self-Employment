<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
    data-bs-target="#show_client{{ $client->id }}">
    {{ __('Show') }}
</button>

<!-- Modal -->
<div class="modal fade" id="show_client{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ $client->PictureClient }}" width="70" height="70" alt="Profile"
                    class="rounded-circle">
                <h5 class="modal-title m-4" id="staticBackdropLabel">{{ $client->name }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane fade show active profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">{{ $client->about_me }}</p>
                            <hr>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{ $client->name }}</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8">{{ $client->company }}</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8">{{ $client->country }}</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">{{ $client->phone }}</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $client->email }}</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Link</div>
                                <div class="col-lg-9 col-md-8">{{ $client->link }}</div>
                                <hr>
                            </div>
                        </div>

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
