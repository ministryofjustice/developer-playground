<x-app-layout>
    <x-form-card>
        <span
            class="govuk-caption-l">Licence #{{ $business_case->licence->id }}, for {{ $business_case->tool->name }}</span>
        <h1 class="govuk-heading-xl">{{ $business_case->name }}</h1>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <div class="govuk-grid-row">
            <div class="govuk-grid-column-three-quarters">
                <form method="POST" action="{{ route('business-cases-patch', $business_case->id) }}">
                    @csrf
                    {!! method_field('patch') !!}
                    {{-- Name --}}
                    <x-form-group
                        id="id"
                        type="hidden"
                        value="{!! $business_case->id !!}"
                    />

                    {{-- Name --}}
                    <x-form-group
                        id="name"
                        label="Name"
                        type="text"
                        value="{!! $business_case->name !!}"
                        :required="true"
                        :autofocus="true"
                    />

                    {{-- Email --}}
                    <x-form-group
                        id="link"
                        label="Link"
                        type="text"
                        value="{!! $business_case->link !!}"
                        :required="true"
                    />

                    <div>
                        <x-button>
                            {{ __('Save and continue') }}
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </x-form-card>
</x-app-layout>
