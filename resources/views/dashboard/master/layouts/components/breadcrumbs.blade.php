<ol class="breadcrumb m-0 py-0">
    @foreach ($breadcrumbs as $breadcrumb)
        @if (!empty($breadcrumb['url']) && empty($breadcrumb['active']))
            <li class="breadcrumb-item">
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
            </li>
        @elseif(!empty($breadcrumb['active']))
            <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
        @else
            <li class="breadcrumb-item">{{ $breadcrumb['label'] }}</li>
        @endif
    @endforeach
</ol>
