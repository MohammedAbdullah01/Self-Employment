@props(['name', 'type' => 'text', 'value' => '', 'lable' => ''])

<label for="recipient-name" class="col-form-label float-start">{{ $lable }}</label>
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" autocomplete="off"
    {{ $attributes->class(['form-control mb-3', 'is-invalid' => $errors->has($name)]) }}>
@error($name)
    <b class="invalid-feedback">
        {{ $message }}
    </b>
@enderror
