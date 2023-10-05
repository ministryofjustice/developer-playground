@push('head')
    <script src="{{ asset('assets/js/icons.js')}}"></script>
@endpush
<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <x-crud-index-header
        title="{{ __('Organisations') }}"
        route="{{ route('organisations-create') }}"
    ></x-crud-index-header>

    <table class="govuk-table">
        @foreach($organisations as $organisation)
            <tr class="govuk-table__row">
                <td>
                    <x-crud-index-tool-bar
                        title="{{ __($organisation->name) }}"
                        edit="{{ route('organisations-edit', $organisation->slug) }}"
                    ></x-crud-index-tool-bar>
                </td>
            </tr>
            <tr class="govuk-table__row">
                <td>
                    <table class="govuk-table">
                        <thead class="govuk-table__head">
                        <tr class="govuk-table__row">
                            <th scope="col" class="govuk-table__header">Address</th>
                            <th scope="col" class="govuk-table__header">Description</th>
                        </tr>
                        </thead>
                        <tbody class="govuk-table__body">
                        <td class="govuk-table__cell">{{ $organisation->address }}</td>
                        <td class="govuk-table__cell">{{ $organisation->description }}</td>
                        </tbody>
                    </table>
                </td>
            </tr>
            @if(count($organisation->teams) > 0)
                <tr>
                    <td class="govuk-table__body" colspan="2">
                        <strong>Teams</strong>
                        <div class="govuk-inset-text govuk-body-s">
                            @foreach($organisation->teams as $team)
                                @if($loop->index < 7)
                                    {{ $team->name }}@if($loop->count > 1 && (!$loop->last && $loop->index < 6)),@endif
                                @elseif($loop->index === 7)
                                    ... <x-nav-link href="{{route('teams')}}">view all teams</x-nav-link>
                                @else
                                    @continue
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</x-app-layout>
