<div class="govuk-grid-row crud-index-tool-bar govuk-!-padding-top-7">
    <div class="govuk-grid-column-two-thirds">
        <h3>{!! $title !!}</h3>
    </div>
    <div class="align-right govuk-!-padding-top-4 govuk-!-padding-right-3">
        <a class="govuk-button" href="{{ $edit }}" data-module="govuk-button">
            Edit
        </a>

        @if(!empty($delete))
            <form method="post" action="{{ $delete }}">
                <x-input type="hidden" name=""></x-input>
                <button class="govuk-button govuk-button--warning" type="submit" data-module="govuk-button">
                    Delete
                </button>
            </form>
        @endif
    </div>
</div>
