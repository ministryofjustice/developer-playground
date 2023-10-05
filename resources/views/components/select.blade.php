@props(['disabled' => false, 'required' => false, 'autofocus' => false, 'autocomplete' => false])

<select
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
    {{ $autofocus ? 'autofocus' : '' }}
    {!! $attributes->merge(['class' => 'govuk-select govuk-!-width-one-half']) !!}>
    <option></option>
    @foreach ($titles as $key => $val)
        @if (stristr($key, 'isGroup'))
            <optgroup label="{{ $val }}">
                @else
                    <option value="{{ $key }}">{{ $val }}</option>
        @endif
    @endforeach
</select>
