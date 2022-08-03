
<div class="col-12">
    <x-form.input-lable-error type="email" name="email" :value="$email" />
    <x-form.input-lable-error type="hidden" name="token" :value="$token" />
</div>

<div class="col-12">
    <x-form.input-lable-error type="password" name="password" placeholder="Password" />
</div>

<div class="col-12">
    <x-form.input-lable-error type="password" name="password_confirmation" placeholder="Confirm Password " />
</div>

<div class="col-12">
    <button type="submit" class="btn btn-primary">
        {{__('Save')}}
    </button>
</div>
