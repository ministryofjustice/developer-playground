<x-app-layout>
    <x-crud-index-header route="{{ route('contacts-create') }}" title="{{ __('Tooling Contacts') }}"></x-crud-index-header>

    <table class="govuk-table">
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Communication</th>
            <th scope="col" class="govuk-table__header">Tools</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($contacts as $contact)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $contact->path() }}">
                        <img alt="Gravatar image, depicting {{ $contact->name }}"
                             src="https://www.gravatar.com/avatar/{{md5( strtolower( trim( $contact->email ) ) )}}?s=80"
                             class="contact__image contact__image__with-content"
                        />
                        {{ $contact->name }}
                    </x-nav-link>
                </th>
                <td class="govuk-table__cell">
                    {{ $contact->email }} <br>
                    <x-nav-link target="_blank" href="https://mojdt.slack.com/team/{{$contact->slack}}">
                        Slack
                    </x-nav-link>
                </td>
                <td class="govuk-table__cell">
                    @if(count($contact->tools) > 0)
                        @foreach($contact->tools as $tool)
                            @if($loop->index < 3)
                                <x-nav-link href="{{route('tool', $tool->slug)}}" class="govuk-link--no-visited-state">
                                    {{ $tool->name }}
                                </x-nav-link>@if($loop->count > 1 && (!$loop->last && $loop->index < 2)),@endif
                            @elseif($loop->index === 3)
                                ...
                            @else
                                @continue
                            @endif
                        @endforeach
                    @else
                        <small class="italic">No tools under management</small>
                    @endif
                </td>
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="{{ $contact->path() }}" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="{{ $contact->path() }}/edit" class="govuk-button"> Edit</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
