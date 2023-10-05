<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Cost centre
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'cost_centre') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            <x-cost-centres
                summary="When the licence is purchased, where are the costs allocated?"
                :costCentres="$cost_centres"
                :selected="$licence['cost_centre_id'] ?? ''"
            ></x-cost-centres>

            <x-licence-form-buttons
                back="users_current"
                :tool="$tool"
                :complete="$licence_complete"
            />
        </form>
    </x-form-card>
</x-app-layout>
