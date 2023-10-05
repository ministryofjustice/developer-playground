<x-app-layout>
    <x-crud-index-header route="{{ route('slack-settings-create') }}" title="{{ __('Slack Settings') }}"></x-crud-index-header>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Settings</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Webhook</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($settings as $setting)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $setting->path() }}"> {{ $setting->name }} </x-nav-link>
                </th>
                <td class="govuk-table__cell">{{ substr($setting->webhook_url, 33, 90) }}</td>
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="{{ $setting->path() }}" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="{{ $setting->path() }}/edit" class="govuk-button"> Edit</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
