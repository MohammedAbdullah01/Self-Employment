<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-success btn-sm " data-bs-toggle="modal"
    data-bs-target="#edit_category{{ $cate->id }}">
    <i class="bi bi-pencil-square"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="edit_category{{ $cate->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.categories.update', $cate->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('Edit Category') }}</h5>
                    <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6">

                                <x-form.input-lable-error lable="Category Name" type="text" name="name"
                                    :value="$cate->name" />

                            </div>

                            <div class="col-md-6">

                                <x-form.select-lable-error name="parent_id" lable="Parent Category" :options="$categories->pluck('name', 'id')->toArray()"
                                    :selected="$cate->parent_id" />

                            </div>

                            <div class="col-md-12">

                                <x-form.textarea-lable-error lable="{{ __('Description') }}" :value="$cate->description"
                                    name="description" rows="5" />

                            </div>

                            <div class="col-md-12">

                                <x-form.input-lable-error lable="Image" type="file" name="img" /><br>

                                <img class="img-thumbnail" src="{{ $cate->PictureCategory }}" width="100px"
                                    height="100px">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark btn-sm"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-sm">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
