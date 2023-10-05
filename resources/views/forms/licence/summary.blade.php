<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Licence summary
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <p class="govuk-body govuk-!-width-two-thirds">
            You may change your answers.
        </p>

        <dl class="govuk-summary-list govuk-!-width-two-thirds">
            {{-- Projected cost --}}
            <x-summary-list-row
                title="Annual cost"
                value="{!! number_format($licence['user_limit'] * $licence['cost_per_user']) !!}"
            ></x-summary-list-row>

            {{-- Available, single licences --}}
            <x-summary-list-row
                title="Available"
                value="{{number_format($licence['user_limit'] ?? '')}}"
                route="{{ route('licences-create-part', [$tool->slug, 'user_limit']) }}"
            ></x-summary-list-row>

            {{-- Used, single licences --}}
            <x-summary-list-row
                title="Currently used"
                value="{{$licence['users_current'] ?? ''}}"
                route="{{ route('licences-create-part', [$tool->slug, 'users_current']) }}"
            ></x-summary-list-row>

            {{-- Cost per user --}}
            <x-summary-list-row
                title="Cost per user"
                value="{{$licence['cost_per_user'] ?? ''}}"
                route="{{ route('licences-create-part', [$tool->slug, 'cost_per_user']) }}"
            ></x-summary-list-row>

            {{-- Currency --}}
            <x-summary-list-row
                title="Currency"
                value="{{$licence['currency'] ?? ''}}"
                route="{{ route('licences-create-part', [$tool->slug, 'currency']) }}"
            ></x-summary-list-row>

            {{-- Starts --}}
            <x-summary-list-row
                title="Active date"
                value="{{$licence['start']['date'] ?? ''}}"
                route="{{ route('licences-create-part', [$tool->slug, 'start']) }}"
            ></x-summary-list-row>

            {{-- Expires --}}
            <x-summary-list-row
                title="Expires date"
                value="{{$licence['stop']['date'] ?? ''}}"
                route="{{ route('licences-create-part', [$tool->slug, 'stop']) }}"
            ></x-summary-list-row>

            {{-- Cost Centre --}}
            <x-summary-list-row
                title="Cost Centre"
                value="{!! $cost_centre ? $cost_centre->name . ', ' . $cost_centre->number : '' !!}"
                route="{{ route('licences-create-part', [$tool->slug, 'cost_centre']) }}"
            ></x-summary-list-row>

            {{-- Description --}}
            <x-summary-list-row
                title="Description"
                value="{!! $licence['description'] ?? '' !!}"
                route="{{ route('licences-create', $tool->slug) }}"
            ></x-summary-list-row>
        </dl>

        <p class="govuk-body govuk-!-width-two-thirds">
            If completely happy, save your licence to continue.
        </p>

        <form method="POST" action="{{ route('licences-session-store', $tool->slug) }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            <div>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
