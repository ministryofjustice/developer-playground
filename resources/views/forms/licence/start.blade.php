<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Start date
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'start') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            {{-- Start date --}}
            <x-form-group
                id="start"
                label="When does this licence begin?"
                type="date"
                :value="$licence['start'] ?? ''"
                :required="true"
                :autofocus="true"
            />

            <x-licence-form-buttons
                back="currency"
                :tool="$tool"
                :complete="$licence_complete"
            />
        </form>
    </x-form-card>
</x-app-layout>
