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
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault{{ $loop->index }}"
            value="{{ $option }}" {{ old($name, $checked) == $option ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault{{ $loop->index }}">
            {{ $option }}
        </label>
    </div>
@endforeach