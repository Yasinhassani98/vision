@props([
    'label' => null,
    'options',
    'name',
    'checked',
])
@if ($label)
    <label for=""> {{ $label }} </label>
@endif


@foreach ($options as $option)
    <div class="form-check">
        <input class="form-check-input" name="{{ $name }}" type="radio" id="flexRadioDefault1"
            value="{{ $option }}" {{ old($name, $checked) == $option ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault1">
            {{ $option }}
        </label>
    </div>
@endforeach