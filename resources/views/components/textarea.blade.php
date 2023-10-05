@props(['disabled' => false, 'required' => false, 'value' => '', 'class' => ''])

<textarea {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} {!! $attributes->merge(['class' => 'govuk-textarea ' . ($class ? $class : 'govuk-!-width-one-half')]) !!}>{!! $value !!}</textarea>

