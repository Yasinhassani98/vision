@props([
    'label' => null,
    'placeholder' => null,
    'step' => null,
    'type' => 'text',
    'name',
    'value',
])
@if ($label)
    <label for=""> {{ $label }} </label>
@endif
<input type="{{ $type }}" name="{{ $name }}" step="{{ $step }}" @if ($placeholder) placeholder="{{ $placeholder }}"@endif
       value="{{ $value ?? old($name) }}" class="form-control
        @error($name)
            is-invalid   
        @enderror
        ">
{{-- first method to show errors under the input (the best + small text) --}}
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror