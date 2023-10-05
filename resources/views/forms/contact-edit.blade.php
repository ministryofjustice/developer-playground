<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            Edit: {!! $contact->name ?? '' !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('contacts-patch', $contact->id) }}">
            @csrf
            {!! method_field('patch') !!}
            {{-- Name --}}
            <x-form-group
                id="id"
                type="hidden"
                value="{!! $contact->id !!}"
            />

            {{-- Name --}}
            <x-form-group
                id="name"
                label="Name"
                type="text"
                value="{!! $contact->name !!}"
                :required="true"
                :autofocus="true"
            />

            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                type="text"
                value="{!! $contact->email !!}"
                :required="true"
            />

            {{-- Slack --}}
            <x-form-group
                id="slack"
                label="Slack ID"
                type="text"
                value="{!! $contact->slack !!}"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>

        <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
        <div class="govuk-!-width-two-thirds">
            <h3 class="govuk-heading-m">Remove the contact</h3>
            <p class="govuk-body">
                Please be aware that this action is irreversible. Once you have removed the contact, any associations
                with tooling will be gone.
            @if(count($contact->tools) > 0)
                <ul class="govuk-list">
                    @foreach($contact->tools as $tool)
                        <li>
                            <x-nav-link href="{{route('tool', $tool->slug)}}" class="govuk-link--no-visited-state">
                                {{ $tool->name }}
                            </x-nav-link>
                        </li>
                    @endforeach
                </ul>
                <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
            @else
                <br>
                <br>
                <strong class="govuk-tag govuk-tag--green">
                    safe to remove
                </strong>
                <small class="italic">No tools under management</small>
                <br>
                <br>
                </p>
            @endif
            <form method="POST" action="{{ route('contacts-delete', $contact->id) }}">
                @csrf
                {!! method_field('delete') !!}
                <x-button class="govuk-button--warning">Remove {{$contact->name}}</x-button>
            </form>
        </div>
    </x-form-card>
</x-app-layout>
