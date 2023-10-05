<div>

    @if(!empty($title))
        <h1 class="govuk-heading-xl"
            {{ $title }}
        </h1>
    @endif

    {{ $slot }}
</div>
