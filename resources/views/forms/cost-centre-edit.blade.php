<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Edit {!! $cost_centre->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('cost-centres-patch', $cost_centre->id) }}">
            @csrf
            {!! method_field('patch') !!}
            {{-- Name --}}
            <x-form-group
                id="name"
                label="Cost Centre name"
                type="text"
                value="{!! $cost_centre->name !!}"
                :required="true"
                :autofocus="true"
            />

            {{-- Address --}}
            <x-form-group
                id="number"
                label="Number"
                summary="The allocation number assigned by the MoJ."
                type="text"
                value="{!! $cost_centre->number !!}"
                :required="true"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
