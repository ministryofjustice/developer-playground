<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Licences') }}</h1>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Licences</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Tooling</th>
            <th scope="col" class="govuk-table__header">Usage</th>
            <th scope="col" class="govuk-table__header">Available</th>
            <th scope="col" class="govuk-table__header">Cost</th>
            <th scope="col" class="govuk-table__header">Expires</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($licences as $licence)
            @php
                $format = 'F jS, Y';
                $start = ($licence->start ? $licence->start->format($format) : null);
                $stop = ($licence->stop ? $licence->stop->format($format) : null);

            @endphp
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $licence->path() }}"
                                class="govuk-link--no-visited-state"
                    >
                        {{ $licence->tool->name }}
                    </x-nav-link>
                    <div class="app-hint" title="{{ $licence->costCentre->name ?? '' }}">
                        <small>CC: {{$licence->costCentre->number ?? ''}}</small>
                    </div>
                </th>
                @if(!$stop)
                    <td class="govuk-table__cell" colspan="4">
                        <strong class="govuk-tag govuk-tag--blue">
                            Incomplete
                        </strong> Add data to present information here.</td>
                @else
                    <td class="govuk-table__cell">
                        <strong class="govuk-tag govuk-tag--purple">
                            {{ $licence->usage ?? 0 }}%
                        </strong>
                    <td class="govuk-table__cell">{{ $licence->user_limit - $licence->users_current }} <small>({{$licence->user_limit}})</small></td>
                    <td class="govuk-table__cell">&pound;{{ number_format($licence->users_current * $licence->cost_per_user) }}</td>
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
