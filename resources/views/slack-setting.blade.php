<x-app-layout>
    <x-nav-link class="govuk-button align-right" href="{{ route('slack-settings-edit', $setting['slug']) }}">Edit
    </x-nav-link>
    <h1 class="govuk-heading-xl">Webhook: {{ $setting['name'] }}</h1>

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <p class="govuk-body">
                <strong>URL</strong><br>{{ $setting['webhook_url'] }}
            </p>
        </div>
    </div>
</x-app-layout>
