<button {{ $attributes->merge(['type' => 'submit', 'class' => 'govuk-button', 'data-module' => 'govuk-button']) }}>
    {{ $slot }}
    @if(isset($withArrow) && $withArrow === true)
        <svg class="govuk-button__start-icon" xmlns="http://www.w3.org/2000/svg" width="12.5"
             height="14" viewBox="0 0 33 40" aria-hidden="true" focusable="false">
            <path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z"></path>
        </svg>
    @endif
</button>
