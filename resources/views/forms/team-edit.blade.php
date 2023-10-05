<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('teams') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Edit: {!! $team->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('teams-patch', $team->id) }}">
            @csrf
            {!! method_field('patch') !!}
            <x-form-group
                id="organisation_id"
                type="hidden"
                value="{{ $team->organisation_id }}"
            >

            </x-form-group>

            {{-- Name --}}
            <x-form-group
                id="name"
                label="Team name"
                type="text"
                value="{!! $team->name !!}"
                :required="true"
                :autofocus="true"
            />

            {{-- Comms URL --}}
            <x-form-group
                id="comms_url"
                label="Comms URL"
                summary="Used to deliver important messages about tooling or licences.<br>Currently supported: Slack channel handle in the form of; #the-channel"
                type="text"
                value="{!! $team->comms_url !!}"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
