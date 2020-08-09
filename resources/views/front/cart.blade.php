@extends('layouts.front')

@section('content')

  <div id="cartIndex">

    <div class="container">
      @include('front.partials.nav')
    </div>

    <div class="container">

      <section style="padding-top: 30px; padding-bottom: 118px;">
        <h2 style="margin-bottom: 66px; font-size: 20px; font-weight:600;" class="text-dark">Carrito</h2>
        <div class="row" style="font-size: 14px; color: #c1c1c1; margin-bottom: 40px;">
          <div class="col-7">Productos</div>
          <div class="col-2 text-center">Cantidad</div>
          <div class="col-2 text-center">Precio</div>
          <div class="col-1"></div>
        </div>

        @for ($i=0; $i < 4; $i++)
          <div class="row align-items-center" style="margin-bottom: 38px;">

            <div class="col-7">
              <div class="d-flex align-items-center">
                <div style="width: 71px; height: 71px; border-radius: 100%; overflow: hidden; background-image: url('{{ asset('images/example-show-product-1.png') }}'); background-position: center center; background-repeat: no-repeat; background-size: 100%" class="position-relative"></div>
                <div style="margin-left:50px">
                  <h3 style="font-size: 16px;font-weight: 600;" class="mb-1">Queso Gouda</h3>
                  <div style="color: #c4c4c4; font-size:13px; font-weight: 300;">#1261311</div>
                </div>
              </div>
            </div>

            <div class="col-2">
              <div class="text-dark text-center" style="font-size: 16px;line-height: 1.5;">
                <div class="d-inline-block border" style="border-radius: 50px;">
                  <div class="d-flex align-items-center" style=" padding: 13px 30px">
                    <div class="text-dark" style="font-size: 20px">-</div>
                    <div style="padding: 0 21px;font-weight: 600;">1</div>
                    <div class="text-dark" style="font-size: 20px">+</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-2 text-center">
              <div style="font-weight: 600; font-size: 16px;">$89.99</div>
            </div>

            <div class="col-1 text-right">
              <a href="#" class="text-dark" style="font-size: 20px"><i class="fas fa-times"></i></a>
            </div>
          </div>
        @endfor
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
            <a href="#" class="btn btn-secondary btn-lg text-white text-uppercase" style="font-size: 13px; font-weight: 600; padding: 15px 53px; border-radius: 50px;">TRAMITAR PEDIDO</a>
          </div>
        </div>
      </section>
    </div>

  </div>

@endsection
