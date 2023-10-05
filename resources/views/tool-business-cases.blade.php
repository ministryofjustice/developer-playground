<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Business Cases for ' . $tool->name) }}</h1>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Business Cases</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Links</th>
            <th scope="col" class="govuk-table__header">Created</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($tool->businessCases as $business_case)
            <tr class="govuk-table__row">
                <td class="govuk-table__cell">{{ $business_case->name }}</td>
                <td class="govuk-table__cell">{{ $business_case->link }}</td>
                <td class="govuk-table__cell">
                    {{ $business_case->created_at->format('jS F Y') }} <br>
                    <span class="app-hint" title="Last Updated">
                        <small>
                            LU:  {{ $business_case->updated_at->format('jS F Y') }}
                        </small>
                    </span>
                </td>
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="{{ route('business-case', $business_case->slug) }}" class="govuk-button"> View
                    </x-nav-link>
                    <x-nav-link href="{{ route('business-cases-edit', $business_case->slug) }}" class="govuk-button">
                        Edit
                    </x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
