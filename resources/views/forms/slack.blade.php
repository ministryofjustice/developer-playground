<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Register a Slack Webhook
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>


        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('slack-settings') }}">
                @csrf

                {{-- Select a team --}}
                <x-form-group
                    id="name"
                    label="Name"
                    summary="Provide a unique name to help identify your webhook."
                    type="text"
                    :required="true"
                    :autofocus="true"
                />

                {{-- Channel --}}
                <x-form-group
                    id="channel"
                    label="Channel"
                    summary="Using the format: #channel-name"
                    type="text"
                    :required="true"
                />

                {{-- webhook_url --}}
                <x-form-group
                    id="webhook_url"
                    label="Webhook"
                    summary="Please enter the URL endpoint for the webhook"
                    type="text"
                    :required="true"
                />

                <div>
                    <x-button>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-form-card>
</x-app-layout>
