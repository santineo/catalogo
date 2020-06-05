@if ($category)
  <div class="mb-4 {{ isset($cssClass) ? $cssClass : '' }}">
    <a href="{{ route('front.products.index', ['category' => $category->id]) }}" class="card card-category border-0 d-flex align-items-center justify-content-center {{ !$image ? 'no-image' : '' }}">
      <div class="card-category-image" style="background-image: url('{{ $image }}')"></div>
      <div class="card-category-name px-3 text-center font-weight-bold h3 position-relative">{{ $category->name }}</div>
    </a>
  </div>
@endif
