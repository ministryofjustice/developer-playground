<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <x-crud-index-header
        title="{{ __('Teams') }}"
        route="{{ route('teams-create') }}"
    ></x-crud-index-header>

    <table class="govuk-table crud-index-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Available teams</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Slack Handle</th>
            <th scope="col" class="govuk-table__header">Organisation</th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($teams as $team)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    {{ $team->name }} <br>
                    <small>
                    (
                        <x-nav-link href="{{ route('team', $team->slug) }}" :no_visit="true">view</x-nav-link> &nbsp;|&nbsp;
                        <x-nav-link href="{{ route('teams-edit', $team->slug) }}" :no_visit="true">edit</x-nav-link>
                    )
                    </small>
                </th>
                <td class="govuk-table__cell">{{ $team->comms_url }}</td>
                <td class="govuk-table__cell">{{ $team->organisation->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
