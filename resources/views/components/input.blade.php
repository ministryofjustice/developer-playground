@props(['disabled' => false, 'required' => false, 'autofocus' => false, 'autocomplete' => false])

<input {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} {{ $autofocus ? 'autofocus' : '' }} {{ $autocomplete ? 'autocomplete=' . $autocomplete: '' }} {!! $attributes->merge(['class' => 'govuk-input']) !!}>
