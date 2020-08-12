@extends('layouts.front')

@section('content')

  <div id="cartIndex">

    <div class="container">
      @include('front.partials.nav')
    </div>

    <div class="container">

      <section style="padding-top: 30px; padding-bottom: 118px;">
        <cart-products></cart-products>

        <div style="padding-top: 38px;" class="d-flex align-items-center justify-content-between">
          <a href="#" class="text-dark" style="font-size:14px;">
            <i class="icon-left"></i>
            <span style="margin-left:24px;font-weight:600; ">Continuar Comprando</span>
          </a>
          <div class="">
            {{-- CODIGO PROMOCIONAL --}}
          </div>
          <div class="d-flex align-items-center">
            <div style="margin-right: 72px; font-size: 16px;">
              <span>Total:</span> <strong style="margin-left: 14px;">$159.98</strong>
            </div>
            <a href="{{ route('front.checkout.create') }}" class="btn btn-secondary btn-lg text-white text-uppercase" style="font-size: 13px; font-weight: 600; padding: 15px 53px; border-radius: 50px;">TRAMITAR PEDIDO</a>
          </div>
        </div>
      </section>
    </div>

  </div>

@endsection
