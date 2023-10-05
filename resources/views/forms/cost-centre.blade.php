<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Register a Cost Centre
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('cost-centres-add') }}">
                @csrf

                {{-- Name --}}
                <x-form-group
                    id="name"
                    label="Cost Centre name"
                    type="text"
                    value="{{ old('name') }}"
                    :required="true"
                    :autofocus="true"
                />

                {{-- Address --}}
                <x-form-group
                    id="number"
                    label="Number"
                    summary="The allocation number assigned by the MoJ."
                    type="text"
                    value="{{ old('number') }}"
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
