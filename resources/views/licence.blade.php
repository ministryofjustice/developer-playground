<x-app-layout>
    <x-nav-link class="govuk-button align-right" href="{{ route('licences-edit', $licence['id']) }}">Edit</x-nav-link>
    <span class="govuk-caption-xl">
        Licence #{{ $licence['id'] }} {{!empty($licence->costCentre) ? 'for, ' . $licence->costCentre->name : ''}}
    </span>
    <h1 class="govuk-heading-xl">{{ $licence->tool->name }}</h1>

    <p class="govuk-body">
        {{$licence->description ?? ''}}
    </p>

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <table class="govuk-table">
                <caption class="govuk-table__caption govuk-table__caption--l">Licence data</caption>
                <thead class="govuk-table__head">
                <tr class="govuk-table__row">
                    <th scope="col" class="govuk-table__header">Criteria</th>
                    <th scope="col" class="govuk-table__header">Value</th>
                    <th scope="col" class="govuk-table__header"></th>
                </tr>
                </thead>
                <tbody class="govuk-table__body">
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Available users</th>
                    <td class="govuk-table__cell">{{$licence->user_limit ?? 0}}</td>
                    <td class="govuk-table__cell"></td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Current users</th>
                    <td class="govuk-table__cell">
                        {{$licence->users_current ?? 0}}
                    </td>
                    <td class="govuk-table__cell">
                        <span class="align-right">
                            <x-nav-link href="#" class="govuk-link--no-visited-state">Manage</x-nav-link>
                        </span>
                    </td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Cost per user</th>
                    <td class="govuk-table__cell">{{$licence->cost_per_user ?? 0}}</td>
                    <td class="govuk-table__cell"></td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Cost per user</th>
                    <td class="govuk-table__cell">{{$licence->currency ?? ''}}</td>
                    <td class="govuk-table__cell"></td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Start date</th>
                    <td class="govuk-table__cell">
                        {{!empty($licence->start) ? $licence->start->format('l, jS F Y') : ''}}
                    </td>
                    <td class="govuk-table__cell"></td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Expiry date</th>
                    <td class="govuk-table__cell">
                        {{!empty($licence->stop) ? $licence->stop->format('l, jS F Y') : ''}}
                    </td>
                    <td class="govuk-table__cell"></td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">Cost centre</th>
                    <td class="govuk-table__cell">
                        {{!empty($licence->costCentre) ? $licence->costCentre->name : ''}}<br>
                        {{!empty($licence->costCentre) ? $licence->costCentre->number : ''}}
                    </td>
                    <td class="govuk-table__cell"></td>
                </tr>
                </tbody>
            </table>

            <h2 class="govuk-heading-l">Business cases</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
        <div class="govuk-grid-column-one-third">
            <h2 id="timeline" class="govuk-heading-m">Usage</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
            <x-percent-chart-simple percentage="{{$licence->usage}}"/>
            <div class="govuk-!-margin-9"></div>

            <h2 id="timeline" class="govuk-heading-m">Quotes</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
    </div>
</x-app-layout>
