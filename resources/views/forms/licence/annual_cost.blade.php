<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            {{ $tool->name }}: create a new licence
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'annual_cost') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            <div>
                <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                <x-nav-link href="{{route('licences-create')}}">
                    {{ __('Back') }}
                </x-nav-link>
                <x-button :withArrow="true">
                    {{ __('Continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
