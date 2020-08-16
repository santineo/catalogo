<nav aria-label="breadcrumb">
  <ol class="breadcrumb align-items-center">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}"><i class="icon-home"></i></a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('front.products.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
  </ol>
</nav>
