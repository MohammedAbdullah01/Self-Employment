<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary btn-sm mt-2 mb-2 " data-bs-toggle="modal" data-bs-target="#create_category">
    {{ __('Create Catedgory') }}
</button>

<!-- Modal -->
<div class="modal fade" id="create_category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" class="modal fade" id="create_category" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('Create Category') }}</h5>
                    <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input-lable-error lable="Category Name" name="name" />
                            </div>

                            <div class="col-md-6">
                                <x-form.select-lable-error name="parent_id" lable="Parent Category" :options="$categories->pluck('name', 'id')->toArray()" />
                            </div>

                            <div class="col-md-12">

                                <x-form.textarea-lable-error lable="{{ __('Description') }}" name="description"
                                    rows="5" />


                            </div>
                            <div class="col-md-12">

                                <x-form.input-lable-error lable="Image" type="file" name="img" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark btn-sm"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>



















