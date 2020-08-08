@if ($paginator->hasPages())
  <nav class="d-flex justify-content-between align-items-center">
    {{-- Previous Page Link --}}
    <div>
      @if (!$paginator->onFirstPage())
        <a href="{{ $paginator->previousPageUrl() }}" style="text-decoration:underline; font-size: 13px; font-weight: 600;" class="text-dark" rel="prev" aria-label="@lang('pagination.previous')">Anterior</a>
      @endif
    </div>
    <div class="d-flex align-items-center">
      <div style="font-size: 14px; margin-right: 17px;">Página</div>
      <ul class="pagination mb-0">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page"><span class="page-link text-dark border" style="font-weight:600; padding: 12px 17px;background-color: transparent; border-radius: 0;">{{ $page }}</span></li>
              @else
                <li class="page-item"><a class="page-link text-dark border-0" href="{{ $url }}" style="font-weight:500; padding: 12px 17px;background-color: transparent; border-radius: 0;">{{ $page }}</a></li>
              @endif
            @endforeach
          @endif
        @endforeach

      </ul>
    </div>
    {{-- Next Page Link --}}
    <div>
      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="text-decoration:underline; font-size: 13px; font-weight: 600;" class="text-dark" rel="next" aria-label="@lang('pagination.next')">Próxima</a>
      @endif
    </div>
  </nav>
@endif
