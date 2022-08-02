<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-success btn-sm me-md-2" data-bs-toggle="modal"
    data-bs-target="#edit_gallery{{ $work->id }}">
    <i class="ti-slice mr-2"></i>
</button>

<div class="modal fade" id="edit_gallery{{ $work->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3 mb-2 bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Product') }}</h5>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                    aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update.work', $work->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="container">
                        <x-form.input-lable-error lable="Project Title" name="title" :value="$work->title"
                            placeholder="Write The title Of The project At Least 5 Characters..." />

                        <x-form.textarea-lable-error lable="Project Description" name="description"
                            placeholder="Write The Description Of The project At Least 10 Characters..." rows="6"
                            :value="$work->description" />

                        <x-form.input-lable-error lable="Project Main Image" name="main_photo" type="file" />
                        <img src="{{ asset('storage/freelancer/latestwork/' . $work->main_photo) }}"
                            class="img-thumbnail" alt="..." width="100%" height="250px">

                        @if (count($work->photos) < 6)
                            <x-form.input-lable-error lable="Project Sub Images" name='sub_images[]' type="file"
                                multiple />
                            @error('sub_images.*')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        @endif

                        <div class="card">

                            <div class="card-body">
                                @forelse ($work->photos as $image)
                                    <div class="card card text-white bg-dark mb-3 mt-2">
                                        <img src="{{ asset('storage/freelancer/latestwork/' . $image->sub_images) }}"
                                            class="card-img-top" height="250px" width="100%" alt="...">
                                        <a class="btn btn-outline-danger btn-sm "
                                            href="{{ route('user.destroy.work.sub_images', $image->id) }}" onclick="event.preventDefault();
                                                            document.getElementById('remove-photo').submit();">
                                            {{ __('X') }}
                                        </a>
                                    </div>
                                @empty

                                    <div class=" alert alert-danger text-center mt-2">
                                        {{ __('There Are No Sub Images !') }}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
                @if (count($work->photos) > 0)
                    <form id="remove-photo" action="{{ route('user.destroy.work.sub_images', $image->id) }}"
                        method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
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
                <form action="{{ route('user.update.work', $work->id) }}" method="post"
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
                                    href="{{ route('user.destroy.work.sub_images', $image->id) }}" onclick="event.preventDefault();
                                    document.getElementById('remove_photoa').submit();">
                                    {{ __('X') }}
                                </a>
                                <img src="{{ asset('storage/freelancer/latestwork/' . $image->sub_images) }}"
                                    class="card-img-top" alt="...">


                            </div>
                        </div>

                        <form action="{{ route('user.destroy.work.sub_images', $image->id) }}" id="remove_photoa"
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
