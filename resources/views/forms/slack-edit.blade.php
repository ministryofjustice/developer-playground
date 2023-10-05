<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Edit: {!! $settings->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('slack-settings-patch', $settings->id) }}">
                @csrf
                {!! method_field('patch') !!}
                {{-- Name --}}
                <x-form-group
                    id="name"
                    label="Name"
                    type="text"
                    value="{!! $settings->name !!}"
                    :required="true"
                    :autofocus="true"
                />

                {{-- Channel --}}
                <x-form-group
                    id="channel"
                    label="Channel"
                    summary="Using the format: #channel-name"
                    type="text"
                    value="{!! $settings->channel !!}"
                    :required="true"
                />

                {{-- Email --}}
                <x-form-group
                    id="webhook_url"
                    label="Webhook"
                    type="text"
                    value="{!! $settings->webhook_url !!}"
                    :required="true"
                />
                <div>
                    <x-button>
                        {{ __('Save and continue') }}
                    </x-button>
                </div>

            </form>
        </div>
    </x-form-card>
</x-app-layout>
