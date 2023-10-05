<x-app-layout>
    <x-crud-index-header
        route="{{ route('cost-centres-create') }}"
        title="{{ __('Cost Centres') }}"
    />

    @if(count($cost_centres) > 0)
    <table class="govuk-table">
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Number</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($cost_centres as $cost_centre)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link
                        href="{{route('cost-centre', $cost_centre->slug)}}">
                        {!! $cost_centre->name !!}
                    </x-nav-link>
                </th>
                <td class="govuk-table__cell">{{ $cost_centre->number }}</td>
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="{{route('cost-centre', $cost_centre->slug)}}" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="{{route('cost-centres-edit', $cost_centre->slug)}}" class="govuk-button"> Edit</x-nav-link>
                    <form method="POST" action="{{ route('cost-centres-delete', $cost_centre->id) }}" class="govuk-!-display-inline">
                        @csrf
                        {!! method_field('delete') !!}
                        <x-button class="govuk-button govuk-button--warning">
                            {{ __('Delete') }}
                        </x-button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="govuk-!-width-two-thirds">
            <p class="govuk-body">
                There are currently no cost centres in the system to display. Please add one.
            </p>
        </div>
    @endif
</x-app-layout>
