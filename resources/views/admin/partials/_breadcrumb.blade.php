<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item {{ !isset($breadcrumbs) ? 'active' : '' }}"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @if(isset($breadcrumbs))
      @foreach ($breadcrumbs as $breadcrumb)
        @if(isset($breadcrumb['active']))
          <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
        @else
          <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
        @endif
      @endforeach
    @endif
  </ol>
</nav>
