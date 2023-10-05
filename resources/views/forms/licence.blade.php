<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            {{ $tool->name }}: create a new licence
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences') }}">
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
            />

            {{-- define the available licences --}}
            <x-form-group
                id="user_limit"
                label="Available licences"
                summary="How many users can use this licence?"
                type="text"
                :required="true"
            />

            {{-- define the currently used licences --}}
            <x-form-group
                id="users_current"
                label="Current occupancy"
                summary="How many users currently hold a licence?"
                type="text"
                :required="true"
            />

            {{-- Annual cost --}}
            <x-form-group
                id="annual_cost"
                label="Annual cost"
                summary="How much do we pay each year?"
                type="text"
                :required="true"
            />

            {{-- Cost per user --}}
            <x-form-group
                id="cost_per_user"
                label="Single user licence cost"
                summary="What is the cost per user?"
                type="text"
            />

            {{-- Currency --}}
            <x-form-group
                id="currency"
                label="Currency symbol"
                type="text"
                class="govuk-input--width-4"
            />

            {{-- Stop date --}}
            <x-form-group
                id="stop"
                label="What is the expiration date for this licence?"
                type="date"
            />

            <div>
                <x-button>
                    {{ __('Continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
