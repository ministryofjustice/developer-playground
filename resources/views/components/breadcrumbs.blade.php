@php
    $build_url = route('dashboard');
@endphp
@if(!Route::is('dashboard'))
<div class="govuk-breadcrumbs govuk-breadcrumbs--collapse-on-mobile">
    <ol class="govuk-breadcrumbs__list">
        <li class="govuk-breadcrumbs__list-item">
            <a href="{{ $build_url }}">Dashboard</a>
        </li>
        @foreach ($paths as $path)
            @if(!empty($path))
                @php
                    $build_url = $build_url . '/' . $path;
                    $path_clean = ucwords(str_replace(['-', '_'], ' ', $path));
                @endphp
                <li class="govuk-breadcrumbs__list-item">
                    @if($loop->last)
                        {{ $path_clean }}
                    @else
                        <a class="govuk-breadcrumbs__link" href="{{ $build_url }}">
                            {{ $path_clean }}
                        </a>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
</div>
@endif
