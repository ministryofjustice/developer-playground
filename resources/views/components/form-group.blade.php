@props([
'id',
'label' => null,
'summary' => null,
'type' => null,
'value' => '',
'required' => false,
'autofocus' => false,
'autocomplete' => false,
'class' => ''
])

@isset ($id, $type)
    <div class="govuk-form-group">
        @if($type !== 'date')
            <x-label class="govuk-label" for="{{ $id }}">
                {{ $label }}
            </x-label>
        @endif
        @isset ($summary)
            <x-summary id="{{ $id }}-hint">
                {!! $summary !!}
            </x-summary>
        @endif
        @switch($type)
            @case('text')
            <x-input
                id="{{ $id }}"
                type="text"
                name="{{ $id }}"
                class="{{ $class }}"
                :value="$value"
                :required="$required"
                :autofocus="$autofocus"></x-input>
            @break
            @case('hidden')
            <x-input
                id="{{ $id }}"
                type="hidden"
                name="{{ $id }}"
                class="{{ $class }}"
                :value="$value"></x-input>
            @break
            @case('password')
            <x-input
                id="{{ $id }}"
                type="password"
                name="{{ $id }}"
                class="{{ $class }}"
                :required="$required"
                :autocomplete="$autocomplete"></x-input>
            @break

            @case('textarea')
            <x-textarea
                id="{{ $id }}"
                name="{{ $id }}"
                class="{{ $class }}"
                :value="$value"
                :required="$required"></x-textarea>
            @break

            @case('date')
            <x-date
                id="{{ $id }}"
                label="{!! $label !!}"
                :value="$value"
                :required="$required"
            ></x-date>
            @break
        @endswitch
    </div>
@endif
