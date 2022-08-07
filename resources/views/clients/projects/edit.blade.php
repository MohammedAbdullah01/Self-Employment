<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-success btn-sm me-md-2" data-bs-toggle="modal"
    data-bs-target="#edite_projects{{ $project->id }}">
    <i class="ti-pencil-alt"></i>
</button>

<!-- Modal -->
<div class="modal fade " id="edite_projects{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="text-start" action="{{ route('client.update.project', $project->id) }} " method="post">
            @csrf
            @method('PUT')

            <div class="modal-content p-3 mb-2 bg-white text-primary ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Edit The Project') }}
                    </h5>
                    <button type="button" class="btn btn-light " data-bs-dismiss="modal" aria-label="Close"><i
                            class="ti-close"></i></button>
                </div>
                <div class="modal-body ">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <x-form.input-lable-error lable="Project Title" name="title" :value="$project->title"
                                placeholder="Include a Short Title That Accurately Describes Your Project" />
                        </div>
                        <div class="form-group col-md-6">
                            <x-form.select-lable-error lable="Project Category" name="category_id" :options="$categories"
                                :selected="$project->category_id" />
                        </div>

                        <div class="form-group col-md-4">
                            <x-form.select-lable-error lable="Project Type" name="type" :options="$types"
                                :selected="$project->type" />
                        </div>

                        <div class="form-group col-md-4">
                            <x-form.select-lable-error lable="Project Budget " name="budget" :options="$budgets"
                                :selected="$project->budget" />
                        </div>

                        <div class="form-group col-md-4">
                            <x-form.input-lable-error lable="Project Delivery (Day)" name="delivery_period"
                                :value="$project->delivery_period" placeholder="When Do You Need To Receive Your Project ?" />
                        </div>

                        <label class="col-form-label float-left" for="">Project Required Skills</label>
                        <div class="form-group col-md-12">
                            <x-form.input-lable-error name="skills" data-role="tagsinput" :value="Str::upper($project->skills)"
                                placeholder="Determine The Most Important Skills Required To Implement Your Project." />
                        </div>

                        <label class="col-form-label float-left" for="">Project Tags</label>
                        <div class="form-group col-md-12">
                            <x-form.input-lable-error name="tags" data-role="tagsinput" :value="implode(
                                ',',
                                $project
                                    ->tags()
                                    ->pluck('name', 'id')
                                    ->toArray(),
                            )"
                                placeholder="Define Keywords To Get Faster Search Results." />
                        </div>


                        <div class="form-group col-md-12">
                            <x-form.textarea-lable-error lable="Project Description" name="description" rows="9"
                                :value="$project->description"
                                placeholder="Enter A Detailed Description Of Your Project And Attach Examples Of What You Want If Possible." />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn btn-outline-dark"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn-sm btn btn-outline-success">{{ __('Update Post') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
