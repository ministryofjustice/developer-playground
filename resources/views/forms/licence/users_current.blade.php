<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Current users
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>
        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('licences-store-session', 'users_current') }}">
                @csrf

                {{-- Tool ID --}}
                <x-input
                    name="tool_id"
                    type="hidden"
                    value="{{ $tool->id }}"
                ></x-input>

                {{-- users_limit --}}
                <x-input
                    name="user_limit"
                    type="hidden"
                    value="{{ $licence['user_limit'] }}"
                ></x-input>

                {{-- define currently used licences --}}
                <x-form-group
                    id="users_current"
                    summary="How many users currently hold a licence?"
                    type="text"
                    value="{{ $licence['users_current'] ?? '' }}"
                    :required="true"
                    :autofocus="true"
                />

                <x-licence-form-buttons
                    back="user_limit"
                    :tool="$tool"
                    :complete="$licence_complete"
                />
            </form>
        </div>
    </x-form-card>
</x-app-layout>
