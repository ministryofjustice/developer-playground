<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            {{ $tool->name }}: create a new licence
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'description') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            {{-- Description --}}
            <x-form-group
                id="description"
                label="Description"
                summary="Optionally describe the licence here."
                type="textarea"
                value="{{ $licence['description'] ?? '' }}"
                :autofocus="true"
            />

            <x-licence-form-buttons :licenceComplete="$licence_complete"></x-licence-form-buttons>
        </form>
    </x-form-card>
</x-app-layout>
