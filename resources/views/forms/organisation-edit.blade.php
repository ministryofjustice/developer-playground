<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Edit {!! $organisation->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('organisations-patch', $organisation->id) }}">
            @csrf
            {!! method_field('patch') !!}
            {{-- Name --}}
            <x-form-group
                id="name"
                label="Organisation"
                type="text"
                value="{!! $organisation->name !!}"
                :required="true"
                :autofocus="true"
            />

            {{-- Address --}}
            <x-form-group
                id="address"
                label="Address"
                summary="The full textual address; 102 Petty France, London, SW1H 9AJ, United Kingdom."
                type="text"
                value="{!! $organisation->address !!}"
                :required="true"
            />

            {{-- Description --}}
            <x-form-group
                id="description"
                label="Description"
                summary="Optionally describe the organisation."
                type="textarea"
                value="{{ $organisation->description }}"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
