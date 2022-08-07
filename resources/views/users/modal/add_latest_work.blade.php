<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary btn-sm me-md-2" data-bs-toggle="modal" data-bs-target="#add_gallery">
    {{ __('Add Work') }}
</button>

<!-- Modal -->
<div class="modal fade " id="add_gallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.store.work') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-content p-3 mb-2 bg-white text-primary ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add The Latest Work</h5>
                    <button type="button" class="btn-close btn btn-light " data-bs-dismiss="modal"
                        aria-label="Close"><i class="ti-close"></i></button>
                </div>
                <div class="modal-body ">

                    <x-form.input-lable-error lable="Project Title" name="title"
                        placeholder="Write The title Of The project At Least 5 Characters..." />

                    <x-form.select-lable-error lable="Project Category" name="category_id" :options="$categories" />

                    <x-form.textarea-lable-error lable="Project Description" name="description"
                        placeholder="Write The Description Of The project At Least 10 Characters..." rows="6" />

                    <x-form.input-lable-error lable="Project Main Image" name="main_photo" type="file" />

                    <x-form.input-lable-error lable="Project Sub Images" name='sub_images[]' multiple type="file" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn btn-outline-dark"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn-sm btn btn-outline-primary">{{ __('Add') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
