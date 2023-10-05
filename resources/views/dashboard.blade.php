<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Dashboard') }}</h1>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-full">
            <x-card
                title="Tools"
                count="{{$data['tooling']['count']}}"
                view="{{ route('tools') }}"
                new="{{ route('tools-create') }}"
            />
            <x-card
                title="Licences"
                count="{{$data['licences']['count']}}"
                view="{{ route('licences') }}"
            />
            <x-card
                title="Business Cases"
                count="{{$data['business-cases']['count']}}"
                view="{{ route('business-cases') }}"
            />
        </div>
    </div>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-full">
            <x-card-chart chart-id="tooling-dashboard-chart" aria-label="Tooling rate"></x-card-chart>
            <x-card-chart chart-id="licence-dashboard-chart" aria-label="Licencing rates"></x-card-chart>
            <x-card-chart chart-id="business-case-dashboard-chart" aria-label="Business Case rates"></x-card-chart>
        </div>
    </div>
    <div class="govuk-grid-row govuk-!-margin-top-9">
        <div class="govuk-grid-column-full">
            <h2 class="govuk-heading-l">Management</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
            <x-card
                title="Organisations"
                count="{{$data['organisations']['count']}}"
                view="{{ route('organisations') }}"
                new="{{ route('organisations-create') }}"
            />
            <x-card
                title="Teams"
                count="{{$data['teams']['count']}}"
                view="{{ route('teams') }}"
                new="{{ route('teams-create') }}"
            />
            <x-card
                title="Contacts"
                count="{{$data['contacts']['count']}}"
                view="{{ route('contacts') }}"
                new="{{ route('contacts-create') }}"
            />
            <x-card
                title="Cost Centres"
                count="{{$data['cost-centres']['count']}}"
                view="{{ route('cost-centres') }}"
                new="{{ route('cost-centres-create') }}"
            />
            <x-card
                title="Webhooks"
                count="{{$data['slack-settings']['count']}}"
                view="{{ route('slack-settings') }}"
                new="{{ route('slack-settings-create') }}"
            />
        </div>
    </div>

</x-app-layout>
