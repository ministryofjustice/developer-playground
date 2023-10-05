<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Procure a tool
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <p class="govuk-body">Please check your answers.</p>

        <form method="POST" action="{{ route('tools-store') }}">
            @csrf

            <dl class="govuk-summary-list">
                <div class="govuk-summary-list__row">
                    <dt class="govuk-summary-list__key">
                        Tool
                    </dt>
                    <dd class="govuk-summary-list__value">
                        {{ $tooling['name'] ?? 'No tool name found' }}
                    </dd>
                    <dd class="govuk-summary-list__actions">
                        <a class="govuk-link" href="{{route('tools-create')}}">
                            Change<span class="govuk-visually-hidden"> name</span>
                        </a>
                    </dd>
                </div>
                <div class="govuk-summary-list__row">
                    <dt class="govuk-summary-list__key">
                        Tool detail
                    </dt>
                    <dd class="govuk-summary-list__value">
                        {{ $tooling['description'] ?? 'No tool details were found' }}
                    </dd>
                    <dd class="govuk-summary-list__actions">
                        <a class="govuk-link" href="{{ route('tools-create') }}">
                            Change<span class="govuk-visually-hidden"> tooling information</span>
                        </a>
                    </dd>
                </div>
                <div class="govuk-summary-list__row">
                    <dt class="govuk-summary-list__key">
                        Main contact
                    </dt>
                    <dd class="govuk-summary-list__value">
                        {{ $contact['name'] ?? 'A contact was not added.' }}<br>
                        {{ $contact['email'] ?? '' }}<br>
                        {{ $contact['slack'] ?? '' }}
                    </dd>
                    <dd class="govuk-summary-list__actions">
                        <a class="govuk-link" href="{{route('tools-create-contact')}}">
                            Change<span class="govuk-visually-hidden"> contact information</span>
                        </a>
                    </dd>
                </div>
                <div class="govuk-summary-list__row">
                    <dt class="govuk-summary-list__key">
                        Business Case
                    </dt>
                    <dd class="govuk-summary-list__value">
                        <strong>{{ $business_case['name'] ?? 'A business case was not added on this occasion' }}</strong><br>
                        {{ $business_case['text'] ?? '' }}
                    </dd>
                    <dd class="govuk-summary-list__actions">
                        <a class="govuk-link" href="{{ route('tools-create-business-case') }}">
                            Change<span class="govuk-visually-hidden"> business case</span>
                        </a>
                    </dd>
                </div>
            </dl>


            <p class="govuk-body">

            </p>
            <div>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
