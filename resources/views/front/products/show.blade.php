@extends('layouts.front')

@section('content')
  <div class="container py-4" v-if="!Cart.updated">
    <div class="card rounded-0">
      <div class="row no-gutters">

        <div class="col-md-7 text-center border-right">
          <img src="{{ $product->getPrimaryImage('large') }}" alt="" style="width: 500px;" class="img-fluid">
        </div>

        <div class="col-md-5">
          <div class="p-4">
            <h2 class="mb-0">{{ $product->title }}</h2>
            @if($product->brand)
              <small>de <a href="{{ route('front.products.index', ['brand' => $product->brand->id]) }}">{{ $product->brand->name }}</a></small>
            @endif
            <div class="mt-2 mb-4">Precio: {{ number_format($product->price, 2, ',', ' ') }}€ </div>
            <div class="mb-4">{{ $product->description }}</div>
            <product-checkout :product="{{ $product->toJson() }}"/>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
