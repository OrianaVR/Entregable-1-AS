{{-- Author: Nawal Oriana Valoyes Renteria --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb {{ $listClass ?? 'mb-1' }}">
        @foreach ($crumbs as $crumb)
            @if (isset($crumb['url']))
                <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}" class="text-decoration-none">{{ $crumb['label'] }}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
