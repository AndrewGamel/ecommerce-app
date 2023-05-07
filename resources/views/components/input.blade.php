@props([
    'label' => '',
    'id' => '',
    'value' => '',
    'placeholder' => '',
    'name',
    'type' => 'text'

])
@isset($label)
    <label for="{{ $id }}">{{ $label }}</label>
@endisset

<input
        type="{{ $type }}"
        value="{{ old($name,$value) }}"
        placeholder="{{ $placeholder }}"
        name="$name"
        {{ $attributes->class
        (['form-control','is-invalid'=> $errors->has($name)]) }} />

{{-- @error()
<p class="invalid-feedback">{{ $message }}</p>
@enderror --}}