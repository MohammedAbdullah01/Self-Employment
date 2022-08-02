<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
    data-bs-target="#show_user{{ $user->id }}">
    {{ __('Show') }}
</button>

<!-- Modal -->
<div class="modal fade" id="show_user{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ $user->PictureFreelancer}}" width="70" height="70" alt="Profile" class="rounded-circle">
                <h5 class="modal-title m-4" id="staticBackdropLabel">{{ $user->name }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">{{ $user->profile->about_me }}</p><hr>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                <div class="col-lg-9 col-md-8">{{ $user->profile->title_job }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Skills</div>
                                <div class="col-lg-9 col-md-8">
                                    @foreach (explode(',', $user->profile->skills) as $skill)
                                        <span class="badge bg-success mb-1">{{ $skill }}</span>
                                    @endforeach
                                </div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Gander</div>
                                <div class="col-lg-9 col-md-8">{{ $user->profile->gander }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8">{{ $user->profile->country }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Hourly Rate</div>
                                <div class="col-lg-9 col-md-8">{{ $user->profile->hourlyRates }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">{{ $user->profile->phone }}</div><hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div><hr>
                            </div>
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
