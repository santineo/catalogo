@extends('layouts.front', ['noFooter' => true])

@section('content')

  <div id="checkout">

    <div class="container">
      @include('front.partials.nav', ['noMenu' => 'Compra 100% protegida'])
    </div>

    <section style="padding-top: 66px; padding-bottom: 123px; border-top: 1px solid #d8d8d8;">
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <checkout-form></checkout-form>
          </div>
          <div class="col-md-4 position-relative" style="padding-top:28px;">
            <div style="background-color: #f8f8f8; padding: 50px 50px 32px 50px;" class="sticky-top">
              <div v-if="Cart.products">

                <h3 style="margin-bottom: 37px; font-size:18px; font-weight: 600;">Tu Carrito</h3>

                <div style="margin-bottom: 31px;">

                    <div class="d-flex" style="margin-bottom: 31px;" v-for="product in Cart.products" :key="product.data.id">
                      <div style="width: 57px; height: 57px; border-radius: 100%; overflow: hidden; background-position: center center; background-repeat: no-repeat; background-size: 100%" :style="`background-image: url('${(product.data.image ? product.data.image.small : Cart.getProductNoImage('small'))}');`"  class="position-relative"></div>
                      <div style="margin-left:12px">
                        <h3 style="font-size: 14px;font-weight: 600; margin-bottom: 13px;">@{{ product.data.title }} (@{{ product.quantity }})</h3>
                        <div style="color: #c4c4c4; font-size:12px; font-weight: 300;">#@{{ product.data.id }}</div>
                      </div>
                      <div class="ml-auto" style="font-size: 14px;font-weight: 600; margin-bottom: 13px;">$@{{ product.data.price.toFixed(2) }}</div>
                    </div>

                </div>

                <div class="d-flex align-items-center" style="border-top: 1px solid #d8d8d8; border-bottom: 1px solid #dedede; padding: 17px 0;">
                  <div class="text-secondary" style="font-weight: 300;">Total</div>
                  <div class="ml-auto" style="font-weight: 600;">$159,98</div>
                </div>
                <div style="margin-top: 17px; color: #868686; font-size: 14px;">¿Tenes un cupón de descuento?</div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
