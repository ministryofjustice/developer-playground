<x-app-layout>
    <span class="govuk-caption-@if(strlen($tool->description) > 60)l @else()xl @endif">{{ $tool->description }}</span>
    <h1 class="govuk-heading-xl">{{ $tool->name }} </h1>
    @php
        // 3 states: NEW = 2; APPROVED = 1; REJECTED = 0
        $approved = 'rejected';
        if (!$tool->approved && $tool->created_at->diff(\Carbon\Carbon::now())->days < 3) {
            $approved = 'new';
        } elseif ($tool->approved) {
            $approved = 'approved';
        }
    @endphp

    <x-tool-approved-banner
        name="{{ $tool->name }}"
        approved="{{ $approved }}"
        tool_id="{{$tool->id}}"/>

    <div class="govuk-tabs" data-module="govuk-tabs">
        <h2 class="govuk-tabs__title">
            Contents
        </h2>
        <ul class="govuk-tabs__list">
            <li class="govuk-tabs__list-item govuk-tabs__list-item--selected">
                <a class="govuk-tabs__tab" href="#licences">
                    Licences
                </a>
            </li>
            <li class="govuk-tabs__list-item">
                <a class="govuk-tabs__tab" href="#business-cases">
                    Business Cases
                </a>
            </li>
            <li class="govuk-tabs__list-item">
                <a class="govuk-tabs__tab" href="#tooling-reviews">
                    Tooling Reviews
                </a>
            </li>
        </ul>
        <div class="govuk-tabs__panel" id="licences">
            <div class="govuk-grid-row">
                <div class="govuk-grid-column-one-half">
                    <h2 class="govuk-heading-m">
                        Licences <br>
                        <span class="app-hint">
                            <small>Total cost:&nbsp; </small>
                        </span>
                        <strong class="govuk-tag">
                            &pound;{{$tool->licences_cost}}
                        </strong>
                    </h2>
                    <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible"/>
                    @if(count($tool->licences) > 0)
                        <table class="govuk-table">
                            <tbody class="govuk-table__body">
                            @foreach($tool->licences as $licence)
                                @if(!empty($licence->user_limit))
                                    <tr class="govuk-table__row">
                                        <th scope="row" class="govuk-table__header no-border">
                                            <small class="app-hint"><strong>Cost</strong></small><br>
                                            &pound;{{number_format($licence->user_limit * $licence->cost_per_user)}}
                                        </th>
                                        <td class="govuk-table__cell no-border">
                                            <small class="app-hint"><strong>Users</strong></small><br>
                                            {{$licence->user_limit}}
                                        </td>
                                        <td class="govuk-table__cell no-border">
                                            &nbsp;<br>
                                            <x-nav-link href="{{ route('licence', $licence->id) }}">View</x-nav-link>
                                        </td>
                                    </tr>
                                    <tr class="govuk-table__row">
                                        <td colspan="3" class="govuk-table__cell app-hint">
                                            @if($licence->costCentre)
                                                <small><strong>Cost centre: </strong>
                                                    <x-nav-link
                                                        href="{{route('cost-centre', $licence->costCentre->slug)}}"
                                                        title="">{{$licence->costCentre->number}}</x-nav-link>
                                                    <br>
                                                    {{$licence->costCentre->name}}
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr class="govuk-table__row">
                                        <td colspan="3" class="govuk-table__cell app-hint">
                                            <small>Licence with ID {{$licence->id}} has not been completed.
                                                <x-nav-link href="{{ route('licences-edit', $licence->id) }}">Click to
                                                    add
                                                    detail
                                                </x-nav-link>
                                            </small><br><br>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="govuk-body">
                            No licences could be found for {{ $tool->name }}.
                        </p>
                    @endif
                    <x-nav-link href="{{route('licences-create', $tool->slug)}}" class="govuk-button">
                        Add new licence
                    </x-nav-link>
                </div>
                <div class="govuk-grid-column-one-half">
                    <h2 class="govuk-heading-m">
                        Usage <br>
                        <span class="app-hint">
                            <small>Available:&nbsp; </small>
                        </span>
                        <strong class="govuk-tag govuk-tag--red">
                            {{$tool->available_users}}
                        </strong>
                    </h2>
                    <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible"/>
                    <x-percent-chart-simple percentage="{{$tool->licence_usage}}"/>
                    <div class="govuk-!-margin-9"></div>
                </div>
            </div>
        </div>
        <div class="govuk-tabs__panel" id="business-cases">
            @if($tool->businessCases && count($tool->businessCases) > 0)
                <table class="govuk-table">
                    <thead class="govuk-table__head">
                    <tr class="govuk-table__row">
                        <th scope="col" class="govuk-table__header">Name</th>
                        <th scope="col" class="govuk-table__header">Documents</th>
                        <th scope="col" class="govuk-table__header">Created</th>
                        <th scope="col" class="govuk-table__header"></th>
                    </tr>
                    </thead>
                    <tbody class="govuk-table__body">
                    @foreach($tool->businessCases as $business_case)
                        <tr class="govuk-table__row">
                            <td class="govuk-table__cell">{{ $business_case->name }}</td>
                            <td class="govuk-table__cell">{{ $business_case->link }}</td>
                            <td class="govuk-table__cell">{{ $business_case->created_at->format('l, jS F Y') }}</td>
                            <td class="govuk-table__cell align-right">
                                <x-nav-link href="{{ route('business-case', $business_case->slug) }}" class="govuk-button">
                                    View
                                </x-nav-link>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="govuk-body">
                    There are currently no business cases registered for {{$tool->name}}.
                </p>
            @endif
            <x-nav-link class="govuk-button" href="{{route('business-cases-create', $tool->slug)}}">
                Add Business Case
            </x-nav-link>
        </div>
        <div class="govuk-tabs__panel" id="tooling-reviews">
            @if($tool->toolingReviews && count($tool->toolingReviews) > 0)
                {{-- for loop over reviews --}}
            @else
                <p class="govuk-body">
                    There are currently no reviews logged for {{$tool->name}}.
                </p>
                <x-nav-link class="govuk-button" href="#">Add Tooling Review</x-nav-link>
            @endif
        </div>
    </div>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <h2 id="timeline" class="govuk-heading-m">Timeline</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">

            <table class="govuk-table tooling-timeline">
                <tbody class="govuk-table__body">
                @foreach($tool->events as $event)
                    @php
                        $the_year = $event->created_at->format('Y');
                    @endphp
                    @if($loop->index === 0 || ($the_year !== $tool->events[$loop->index-1]->created_at->format('Y')))
                        <tr class="govuk-table__row">
                            <td class="govuk-table__cell tooling-timeline__item" colspan="2">
                                <div class="tooling-timeline__date-year">
                                    <strong class="govuk-!-font-size-27">{{$the_year}}</strong>
                                </div>
                            </td>
                        </tr>
                    @endif
                    <tr class="govuk-table__row">
                        <td
                            class="govuk-table__cell tooling-timeline__item"
                            title="{{$event->created_at->format('r')}}">
                            <div class="tooling-timeline__date">
                                <strong>{{$event->created_at->format('d M')}}</strong><br>
                                <small>{{$event->created_at->format('H:i')}}</small>
                            </div>
                        </td>
                        <td class="govuk-table__cell">{!! $event->detail !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="govuk-grid-column-one-third tooling-meta-column">
            @if($tool->contact)
                <h2 id="main-contact" class="govuk-heading-m">Main contacts</h2>
                <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                <div class="govuk-inset-text clearfix">
                    @php
                        $image = md5( strtolower( trim( $tool->contact->email ) ) );
                    @endphp
                    <img alt="Gravatar image" src="https://www.gravatar.com/avatar/{{$image}}"
                         class="contact__image contact__image__with-content"/>
                    <strong>{{$tool->contact->name}}</strong><br>
                    <x-nav-link href="mailto:{{$tool->contact->email}}">Email</x-nav-link>
                    @if(!empty($tool->contact->slack))
                        <br>
                        <x-nav-link target="_blank" href="https://mojdt.slack.com/team/{{$tool->contact->slack}}">
                            Slack
                        </x-nav-link>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
