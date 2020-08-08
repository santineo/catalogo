@extends('layouts.front')

@section('content')
  <div class="bg-white" id="productsIndex">

        <div class="container">
          @include('front.partials.nav')
        </div>


    <section style="padding: 66px 0;">
      <div class="container">
        <div class="d-flex align-items-center" style="margin-bottom: 60px;">
          <h2 class="mb-0" style="font-size: 34px; font-weight: 300;">Quesos <span style="color: #d8d8d8">(133)</span></h2>
          <div class="ml-auto d-flex align-items-center">
            <div style="font-size:13px; font-weight: 600;">Mostrar:</div>
            <select class="custom-select" style="border-radius: 20px; margin-left: 16px;">
              <option value="30" selected>30</option>
              <option value="60">60</option>
              <option value="90">90</option>
            </select>
          </div>
          <div class="d-flex align-items-center" style="margin-left: 16px;">
            <div style="font-size:13px; font-weight: 600;">Ordenar:</div>
            <select class="custom-select" style="border-radius: 20px; margin-left: 16px;">
              <option value="Popular" selected>Popular</option>
              <option value="low_price">Menor Precio</option>
              <option value="bigger_price">Mayor Precio</option>
            </select>
          </div>
        </div>
        @include('front.partials._productList')


          {{ $products->appends(request()->all())->links() }}


        </div>
      </section>

    </div>
  @endsection
