<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Licences for ' . $tool->name) }}</h1>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Licences</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Available</th>
            <th scope="col" class="govuk-table__header">Cost</th>
            <th scope="col" class="govuk-table__header">Expires</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($tool->licences as $licence)
            @php
                $start = ($licence->start ? $licence->start->format('r') : null);
                $stop = ($licence->stop ? $licence->stop->format('r') : null);

            @endphp
            <tr class="govuk-table__row">
                @if(!$stop)
                    <td class="govuk-table__cell" colspan="3">
                        <strong class="govuk-tag govuk-tag--blue">
                            Incomplete
                        </strong> Please update to present data here.</td>
                @else
                    <td class="govuk-table__cell">{{ $licence->user_limit }}</td>
                    <td class="govuk-table__cell">&pound; {{ $licence->user_limit * $licence->cost_per_user }}</td>
                    <td class="govuk-table__cell">{{ $stop }}</td>
                @endif
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="{{ route('licence', $licence->id) }}" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="{{ route('licences-edit', $licence->id) }}" class="govuk-button"> Edit</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
