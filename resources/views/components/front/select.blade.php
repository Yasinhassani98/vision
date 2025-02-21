@props([
    'label' => null,
    'name',
    'options' ,
    'selected' => null,
])

@if ($label)
    <label for="{{ $name }}"> {{ $label }} </label>
@endif

<select name="{{ $name }}" id="{{ $name }}" class="form-control
    @error($name)
        is-invalid
    @enderror
">
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
