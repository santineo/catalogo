@extends('layouts.front')

@section('content')

  <section class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card rounded-0">
          <div class="card-header">
            <h2 class="mb-0">Cesta</h2>
          </div>
          <div class="card-body">
            <cart-products></cart-products>
          </div>
        </div>
      </div>

      <div class="col-md-4"  v-if="Cart.products.length">
        <div class="card rounded-0 text-center px-4 py-3">
          <div class="mb-3 large">Subtotal (@{{ Cart.products.length }} productos): <strong class="c-red">@{{ Cart.getTotal() }}€</strong></div>
          <div>
            <a href="/checkout" class="btn btn-dark">Tramitar Pedido</a>
        </div>
      </div>

      </div>

    </div>
  </section>

  @include('front.partials._randomProductsSection')

@endsection
