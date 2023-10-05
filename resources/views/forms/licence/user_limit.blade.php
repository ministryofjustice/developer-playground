<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Available licences
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('licences-store-session', 'user_limit') }}">
                @csrf

                {{-- Tool ID --}}
                <x-input
                    name="tool_id"
                    type="hidden"
                    value="{{ $tool->id }}"
                ></x-input>

                {{-- define the available licences --}}
                <x-form-group
                    id="user_limit"
                    summary="How many users are included with this licence?"
                    type="text"
                    value="{{ $licence['user_limit'] ?? '' }}"
                    :required="true"
                    :autofocus="true"
                />

                <x-licence-form-buttons
                    back="description"
                    :tool="$tool"
                    :complete="$licence_complete"
                />
            </form>
        </div>
    </x-form-card>
</x-app-layout>
