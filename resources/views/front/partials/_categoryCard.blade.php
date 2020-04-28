<div class="mb-4 {{ isset($cssClass) ? $cssClass : '' }}">
  <a href="{{ $url }}" class="card card-category border-0 d-flex align-items-center justify-content-center">
    <div class="card-category-image" style="background-image: url('{{ $image }}')"></div>
    <div class="font-weight-bold h3 position-relative">{{ $category }}</div>
  </a>
</div>
