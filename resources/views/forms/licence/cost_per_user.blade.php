<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Cost per-user
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>
        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('licences-store-session', 'cost_per_user') }}">
                @csrf

                {{-- Tool ID --}}
                <x-input
                    name="tool_id"
                    type="hidden"
                    value="{{ $tool->id }}"
                ></x-input>

                {{-- Single licence cost--}}
                <x-form-group
                    id="cost_per_user"
                    summary="How much does a single licence cost?"
                    type="text"
                    value="{{ $licence['cost_per_user'] ?? '' }}"
                    :required="true"
                    :autofocus="true"
                />

                <x-licence-form-buttons
                    back="cost_centre"
                    :tool="$tool"
                    :complete="$licence_complete"
                />
            </form>
        </div>
    </x-form-card>
</x-app-layout>
