<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            <span class="govuk-caption-l">
                Modifying licence #{{ $licence->id }}
                {!! !empty($licence->costCentre->name)
                        ? '<br>Allocated to: <strong title="' . $licence->costCentre->name . '">' . $licence->costCentre->number . '</strong>'
                        :''
                !!}
            </span>
            {!! $licence->tool->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-patch', $licence->id) }}">
            @csrf
            {!! method_field('patch') !!}

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{!! $licence->tool->id !!}"
            ></x-input>

            <div class="govuk-grid-row">
                <div class="govuk-grid-column-one-half">
                    <h3 class="govuk-heading-m">Core information</h3>
                    {{-- Description --}}
                    <x-form-group
                        id="description"
                        label="Description"
                        summary="Write a paragraph or 2 to help readers understand the licences purpose."
                        type="textarea"
                        value="{{ $licence->description ?? old('description', '')}}"
                        class="govuk-!-width-full"
                    />

                    {{-- define the available licences --}}
                    <x-form-group
                        id="user_limit"
                        label="Available licences"
                        summary="How many users are included with this licence?"
                        type="text"
                        value="{{ $licence['user_limit'] ?? old('user_limit', '') }}"
                        class="govuk-input--width-5"
                        pattern="[0-9]*"
                        inputmode="numeric"
                        :required="true"
                    />

                    {{-- define currently used licences --}}
                    <x-form-group
                        id="users_current"
                        label="Current users"
                        summary="How many users currently hold a licence?"
                        type="text"
                        value="{{ $licence['users_current'] ?? old('users_current', '')}}"
                        class="govuk-input--width-5"
                        pattern="[0-9]*"
                        inputmode="numeric"
                        :required="true"
                    />

                    {{-- Single licence cost--}}
                    <x-form-group
                        id="cost_per_user"
                        label="Cost per-user"
                        summary="How much does a single licence cost?"
                        type="text"
                        value="{{ $licence['cost_per_user'] ?? old('cost_per_user', '') }}"
                        class="govuk-input--width-5"
                        :required="true"
                    />

                    {{-- Define a currency symbol --}}
                    <x-form-group
                        id="currency"
                        label="Currency code"
                        summary="State the currency code the cost relates to. Use the ISO 3 character standard."
                        type="text"
                        value="{{ $licence['currency'] ?? old('currency', '') }}"
                        class="govuk-input--width-5"
                        pattern="[A-Za-z]{3}"
                        maxlength="3"
                        :required="true"
                    />
                    <x-nav-link href="https://www.exchangerates.org.uk/currency-symbols.html" target="_blank">
                        ISO Currency Codes
                    </x-nav-link>
                    <div class="govuk-!-margin-9"></div>
                </div>
                <div class="govuk-grid-column-one-half">
                    @php
                        if (!$start) {
                            $start = [
                                'day' => old('start_day', ''),
                                'month' => old('start_month', ''),
                                'year' => old('start_year', '')
                            ];
                        }
                        if (!$stop) {
                            $stop = [
                                'day' => old('stop_day', ''),
                                'month' => old('stop_month', ''),
                                'year' => old('stop_year', '')
                            ];
                        }
                    @endphp
                    <h3 class="govuk-heading-m"> Start date </h3>
                    {{-- Start date --}}
                    <x-form-group
                        id="start"
                        type="date"
                        :value="$start ?? ''"
                        :required="true"
                    />

                    <h3 class="govuk-heading-m"> Expiry date </h3>
                    {{-- Stop date --}}
                    <x-form-group
                        id="stop"
                        type="date"
                        :value="$stop ?? ''"
                        :required="true"
                    />

                    <h3 class="govuk-heading-m"> Cost Centre </h3>
                    <x-cost-centres
                        summary="Where are the costs for this licence allocated?"
                        :costCentres="$cost_centres"
                        :selected="$licence->cost_centre_id ?? old('cost_centre_id', '')"
                    ></x-cost-centres>

                </div>
            </div>


            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
