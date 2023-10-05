<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Business Cases') }}</h1>
    <div class="govuk-!-width-two-thirds govuk-!-padding-bottom-9">
        <p class="govuk-body">
            Each licence requires a case defined to help quantify the associated tooling's use and budget allocation.
            It is possible to copy a business case to a licence, for clarity.
        </p>
        <p class="govuk-body">
            Business cases are useful when determining how tooling will be used, the intended audience and how many
            licences are required to satisfy department need.
        </p>
    </div>
    @if(count($business_cases) > 0)
        <table class="govuk-table">
            <thead class="govuk-table__head">
            <tr class="govuk-table__row">
                <th scope="col" class="govuk-table__header">Name</th>
                <th scope="col" class="govuk-table__header">Tool</th>
                <th scope="col" class="govuk-table__header">Links</th>
                <th scope="col" class="govuk-table__header">Content</th>
                <th scope="col" class="govuk-table__header"></th>
            </tr>
            </thead>
            <tbody class="govuk-table__body">
            @foreach($business_cases as $business_case)
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">
                        <x-nav-link href="{{ $business_case->path() }}"> {{ $business_case->name }} </x-nav-link>
                    </th>
                    <th scope="row" class="govuk-table__header">
                        <x-nav-link href="{{ route('tool', $business_case->tool->slug) }}"> {{ $business_case->tool->name }} </x-nav-link>
                    </th>
                    <td class="govuk-table__cell">{{ $business_case->link }}</td>
                    <td class="govuk-table__cell">{{ substr($business_case->text, 0, 150) }}</td>
                    <td class="govuk-table__cell align-right">
                        <form method="post" action="{{route('business-cases-delete', $business_case->id)}}">
                            @csrf
                            {!! method_field('delete') !!}
                            <x-nav-link href="{{ route('business-case', $business_case->slug) }}" class="govuk-button">
                                View
                            </x-nav-link>
                            <x-nav-link href="{{ route('business-cases-edit', $business_case->slug) }}"
                                        class="govuk-button">
                                Edit
                            </x-nav-link>
                            <x-button class="govuk-button govuk-button--warning">Delete</x-button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="govuk-!-width-two-thirds">
            <p class="govuk-body">
                There are currently no business cases in the system to display. You may add a business case by visiting
                a tool and choosing to create a case from the Business Cases section.
            </p>
            <p>
                <x-nav-link href="{{route('tools')}}" class="govuk-button">All Tools</x-nav-link>
            </p>
        </div>
    @endif

</x-app-layout>
