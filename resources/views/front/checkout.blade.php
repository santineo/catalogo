@extends('layouts.front', ['noFooter' => true])

@section('content')

  <div id="checkout">


    @include('front.partials.nav', ['noMenu' => 'Compra 100% protegida'])


    <section class="checkout">
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <checkout-form></checkout-form>
          </div>
          <div class="col-md-4 checkout-products">
            <div class="sticky-top checkout-products-sticky">
              <div v-if="Cart.products">

                <h3 class="checkout-products-title">Tu Carrito</h3>

                <div class="checkout-products-list">

                  <div class="checkout-products-list-item" v-for="product in Cart.products" :key="product.data.id">
                    <div>
                      <div class="checkout-products-list-item-image" :style="`background-image: url('${(product.data.image ? product.data.image.large : Cart.getProductNoImage('thumb'))}');`"></div>
                    </div>
                    <div>
                      <h3 class="checkout-products-list-item-title">@{{ product.data.title }} (@{{ product.quantity }})</h3>
                      <div class="checkout-products-list-item-id">#@{{ product.data.id }}</div>
                    </div>
                    <div class="checkout-products-list-item-price">{{ env('APP_CURRENCY', '$') }}@{{ product.data.price.toFixed(2) }}</div>
                  </div>

                </div>

                <div class="checkout-products-total">
                  <div class="checkout-products-total-label">@lang('messages.shared_total')</div>
                  <div class="checkout-products-total-number">{{ env('APP_CURRENCY', '$') }}@{{ Cart.getTotal() }}</div>
                </div>

                @if (isset($cuponOption))
                  <div class="checkout-products-discount">¿Tenes un cupón de descuento?</div>
                @endif

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
