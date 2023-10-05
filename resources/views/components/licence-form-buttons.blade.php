<div>
    <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
    @if(isset($complete) && $complete === 'yes')
        <x-button>
            {{ __('Continue') }}
        </x-button>
        <x-button :withArrow="true" name="save_summary" value="true">
            {{ __('Save and view summary') }}
        </x-button>
    @else
        @if(isset($back) && $back !== 'description')
            <x-nav-link href="{{route('licences-create-part', [$tool->slug, $back])}}" class="govuk-button">
                {{ __('Back') }}
            </x-nav-link>
        @elseif(isset($back) && $back === 'description')
            <x-nav-link href="{{route('licences-create', $tool->slug)}}" class="govuk-button">
                {{ __('Back') }}
            </x-nav-link>
        @endif
        <x-button :withArrow="true">
            {{ __('Continue') }}
        </x-button>
    @endif
</div>
