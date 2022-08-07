<button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_profile">
    {{ __('Edit Profile') }}
</button>

<div class="modal fade" id="edit_profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3 mb-2 bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Product') }}</h5>
                <button type="button" class="btn-close btn btn-light" data-bs-dismiss="modal" aria-label="Close"><i
                        class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-4 col-form-label">Profile
                            Image</label>
                        <div class="col-md-6 col-lg-6">
                            <img name="avatar" class="img-thumbnail" src="{{ $user->PictureFreelancer }}"
                                height="120px" width="300px" alt="Profile">

                            <div class=" ml-5">
                                <input type="file" name="avatar">
                                @error('avatar')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label mt-4">
                            FullName</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error name="name" :value="$user->name"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label mt-4">About</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.textarea-lable-error name="about_me" rows="6" :value="$user->profile->about_me"
                                placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label mt-4 ">Title Job</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error name="title_job" :value="$user->profile->title_job"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label mt-4">Skills</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error name="skills" data-role="tagsinput" :value="$user->profile->skills"
                                placeholder="Determine The Most Important Skills Required To Implement Your Project." />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label mt-4 ">Gander</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.select-lable-error name="gander" :options="$user->ganders()" :selected="$user->profile->gander" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Country" class="col-md-4 col-lg-3 col-form-label mt-4 ">Country</label>
                        <div class="col-md-8 col-lg-9">
                            <x-country-select name="country" :selected="$user->profile->country" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label mt-4 ">Hourly
                            Rate</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="number" name="hourly_rate" :value="$user->profile->hourly_rate"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label mt-4">Phone</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="tel" name="phone" :value="$user->profile->phone"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label mt-4">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="email" name="email" :value="$user->email"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label mt-4">Twitter
                            Profile</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="url" name="twitter" :value="$user->profile->twitter"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label mt-4">Github
                            Profile</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="url" name="github" :value="$user->profile->github"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label mt-4">Linkedin
                            Profile</label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="url" name="linkedin" :value="$user->profile->linkedin"
                                placeholder="When Do You Need To Receive Your Project ?" />
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
