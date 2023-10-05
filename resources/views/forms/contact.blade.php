<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Create a contact
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('contacts') }}">
            @csrf

            {{-- Select a team --}}
            <x-form-group
                id="name"
                label="Name"
                summary="What is the contacts name?"
                type="text"
                value="{{ old('name', '') }}"
                :required="true"
                :autofocus="true"
            />

            {{-- email --}}
            <x-form-group
                id="email"
                label="Email"
                summary="Please enter the contacts email address."
                type="text"
                value="{{ old('email', '') }}"
                :required="true"
            />

            {{-- email --}}
            <x-form-group
                id="slack"
                label="Slack ID"
                summary="Enter a Slack member ID for this contact."
                type="text"
                value="{{ old('slack', '') }}"
            />

            <div>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
