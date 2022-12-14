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
                <form action="{{ route('client.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-4 col-form-label">Profile
                            Image</label>
                        <div class="col-md-6 col-lg-6">
                            <img name="avatar" class="img-thumbnail" src="{{ $client->PictureClient }}" height="120px"
                                width="300px" alt="Profile">

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

                            {{ __('Full Name') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error name="name" :value="$client->name"
                                placeholder="Enter The Full Name " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label mt-4">
                            {{ __('About Me') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-form.textarea-lable-error name="about_me" rows="6" :value="$client->profile->about_me"
                                placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label mt-4 ">
                            {{ __('Company') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error name="company" :value="$client->profile->company"
                                placeholder="Enter The Name Of The Company" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Country" class="col-md-4 col-lg-3 col-form-label mt-4 ">
                            {{ __('Country') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-country-select name="country" :selected="$client->profile->country" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label mt-4">
                            {{ __('Phone') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="tel" name="phone" :value="$client->profile->phone"
                                placeholder="Enter The Phone" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label mt-4">
                            {{ __('Email') }}
                        </label>

                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="email" name="email" :value="$client->email"
                                placeholder="Enter The Email " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label mt-4">
                            {{ __('Link') }}

                        </label>
                        <div class="col-md-8 col-lg-9">
                            <x-form.input-lable-error type="url" name="linkedin" :value="$client->profile->linke"
                                placeholder="Enter The Link Belonging To The Company Or Link To Your Website" />
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













































{{-- <!-- Modal -->
<div class="modal fade " id="edit_gallery{{ $work->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content p-3 mb-2 bg-white text-primary ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edite Project</h5>
                <button type="button" class="btn-close btn-sm btn-dark " data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form action="{{ route('client.update.work', $work->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-form.input-lable-error lable="Project Title" name="title" :value="$work->title"
                        placeholder="Write The title Of The project At Least 5 Characters..." />

                    <x-form.textarea-lable-error lable="Project Description" name="description"
                        placeholder="Write The Description Of The project At Least 10 Characters..." rows="6"
                        :value="$work->description" />

                    <x-form.input-lable-error lable="Project Main Image" name="main_photo" type="file" />
                    <img src="{{ asset('storage/freelancer/latestwork/' . $work->main_photo) }}" class="img-thumbnail"
                        alt="..." width="100%" height="250px">

                    <x-form.input-lable-error lable="Project Sub Images" name='sub_images[]' multiple type="file" />

                    @forelse ($work->photos as $image)
                        <div class="card">

                            <div class="card-body">
                                <a class="btn btn-outline-danger btn-sm "
                                    href="{{ route('client.destroy.work.sub_images', $image->id) }}" onclick="event.preventDefault();
                                    document.getElementById('remove_photoa').submit();">
                                    {{ __('X') }}
                                </a>
                                <img src="{{ asset('storage/freelancer/latestwork/' . $image->sub_images) }}"
                                    class="card-img-top" alt="...">


                            </div>
                        </div>

                        <form action="{{ route('client.destroy.work.sub_images', $image->id) }}" id="remove_photoa"
                            class="d-none" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    @empty
                    @endforelse



                    <div class="modal-footer">
                        <button type="button" class="btn-sm btn btn-outline-dark"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit"
                            class="btn-sm btn btn-outline-primary">{{ __('Update Project') }}</button>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div> --}}
