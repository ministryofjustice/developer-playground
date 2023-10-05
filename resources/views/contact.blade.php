<x-app-layout>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-one-quarter">
            <img alt="Gravatar image, depicting {{ $contact->name }}"
                 src="https://www.gravatar.com/avatar/{{md5( strtolower( trim( $contact->email ) ) )}}?s=320"
                 class="contact__image"
            />
            <small class="app-hint">
                Image sourced from <x-nav-link href="https://en.gravatar.com/" target="_blank">Gravatar</x-nav-link>
            </small>
        </div>
        <div class="govuk-grid-column-three-quarters">
            <h1 class="govuk-heading-xl">{{ $contact['name'] }}</h1>

            @if(isset($contact->tools) && count($contact->tools) > 0)
                <p class="govuk-body">Main contact for the following tools</p>
                <ol class="govuk-list govuk-list--bullet">
                    @foreach($contact->tools as $tool)
                        <li>
                            <strong><x-nav-link href="{{ $tool->path() }}">{{$tool->name}}</x-nav-link></strong><br>
                            <div class="app-hint">{{$tool->description}}</div>
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="govuk-body">This contact is not associated with any tools.</p>
            @endif
        </div>
    </div>
</x-app-layout>
