@props([
    'label' => null,
    'name',
])
@if ($label)
    <label for=""> {{ $label }} </label>
@endif
<textarea name="{{ $name }}" id="" cols="30" rows="10"
    class="form-control
            @error($name)
                is-invalid   
            @enderror
            "> {{ old($name) }} </textarea>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror