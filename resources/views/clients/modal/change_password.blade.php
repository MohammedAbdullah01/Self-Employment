<button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#change_password">
    {{ __('Change Password') }}
</button>


<div class="modal fade" id="change_password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3 mb-2 bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Change Password') }}</h5>
                <button type="button" class="btn-close btn btn-light" data-bs-dismiss="modal"
                    aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <!-- Change Password Form -->
                <form action="{{ route('user.change.Password') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-4 col-form-label mt-4">
                            {{ __('Current Password') }}
                        </label>
                        <div class="col-md-8 col-lg-8">
                            <x-form.input-lable-error type="password" name="oldpassword" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-4 col-form-label mt-4">
                            {{ __('New Password') }}
                        </label>
                        <div class="col-md-8 col-lg-8">
                            <x-form.input-lable-error type="password" name="password" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-4 col-form-label mt-4">
                            {{ __('Re-enter New Password') }}
                        </label>
                        <div class="col-md-8 col-lg-8">
                            <x-form.input-lable-error type="password" name="password_confirmation" />
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            {{ __('Change Password') }}
                        </button>
                    </div>
                </form><!-- End Change Password Form -->
            </div>
        </div>
    </div>
</div>
