@extends('layouts.front')

@section('content')
  <section class="py-4">
    <div class="container">
      <h2 class="mb-4">Productos</h2>
      <div class="row">
        @if ($products->count())
          <div class="col-12 mb-3">
            @if ($category)
              <div class="mb-2">
                Categoría: "<strong>{{ $category->name }}</strong>"
              </div>
            @endif
            <div>
              {{-- Crear helper para estas cuentas --}}
              @if ($products->lastPage() > 1)
                {{ ($products->currentPage() - 1) * 24 + 1 }}-{{ $products->currentPage() * 24 < $products->total() ? $products->currentPage() * 24 : $products->total() }} de
              @endif
              <strong>{{ $products->total() }}</strong> resultado{{ $products->total() > 1 ? 's' : '' }}
              @if(request('term'))
                para <strong class="text-primary">"{{ request('term') }}"</strong>
              @endif
            </div>
          </div>
          @foreach($products as $product)
            @include('front.partials._productCard', compact($product))
          @endforeach
          <div class="col-12 d-flex justify-content-center mt-3">
            {{ $products->appends(request()->all())->links() }}
          </div>
        @else
          <div class="col-12">
            <div class="h5">
              No se han encontrado productos
              @if(request('term'))
                para el término "<strong>{{ request('term') }}</strong>"
              @endif
              @if ($category)
                en la categoría "<strong>{{ $category->name }}</strong>"
              @endif
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
  @include('front.partials._randomProductsSection')
@endsection
