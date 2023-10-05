<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Currency code
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>
        <div class="govuk-!-width-two-thirds">
            <form method="POST" action="{{ route('licences-store-session', 'currency') }}">
                @csrf

                {{-- Tool ID --}}
                <x-input
                    name="tool_id"
                    type="hidden"
                    value="{{ $tool->id }}"
                ></x-input>

                {{-- Define a currency symbol --}}
                <x-form-group
                    id="currency"
                    summary="State the currency code the cost relates to. Use the ISO 3 character standard."
                    type="text"
                    value="{{ $licence['currency'] ?? '' }}"
                    :required="true"
                    :autofocus="true"
                />

                <x-nav-link href="https://www.exchangerates.org.uk/currency-symbols.html" target="_blank">
                    ISO Currency Codes
                </x-nav-link>

                <x-licence-form-buttons
                    back="cost_per_user"
                    :tool="$tool"
                    :complete="$licence_complete"
                />
            </form>
        </div>
    </x-form-card>
</x-app-layout>
