<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('teams') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <h1 class="govuk-heading-xl">{{ $team->name }}</h1>
</x-app-layout>
