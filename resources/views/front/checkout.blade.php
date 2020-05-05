@extends('layouts.front')

@section('content')
  <section class="container py-4">
    @if (session('cart'))
      <div class="row justify-content-center" v-show="Cart.products.length">
        <h2 class="sr-only">Tramite del pedido</h2>

        <checkout-form class="col-lg-7"></checkout-form>

        <div class="col-lg-5">
          <h3>Productos</h3>
          <div class="card rounded-0">


            <ul class="pl-0 py-3 mb-3 border-bottom checkout-products-list" v-if="Cart.products">

                <li class="d-flex align-items-center mb-3 px-3" v-for="product in Cart.products" :key="product.data.id">
                  <img :src="product.data.image ? product.data.image.small : Cart.getProductNoImage('small')" alt="" width="45" height="45">
                  <div class="small ml-2 pr-3">
                    <div>@{{ product.data.title }}</div> <small class="c-red">@{{ product.data.price.toFixed(2) }}€ / @{{ product.data.selling_type == 1 ? 'Unidad' : 'Kilo' }}</small>
                  </div>
                  <div class="small strong ml-auto text-right" style="width: 70px">
                    @{{ product.quantity }} @{{ product.data.selling_type == 1 ? 'u.' : 'grs.' }}
                  </div>
                </li>

            </ul>
            <div class="d-flex justify-content-between align-items-center pb-3 px-3">
              <div class="font-weight-bold">
                Total
              </div>
              <div class="">
                @{{ Cart.getTotal() }} €
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-warning">
          No tienes productos en tu cesta para tramitar.
        </div>
      @endif
    </div>
  </section>
@endsection
