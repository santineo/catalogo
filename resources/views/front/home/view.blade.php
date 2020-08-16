@extends('layouts.front')

@section('content')
<div class="home position-relative">


  <div class="home-nav">

      @include('front.partials.nav')
    
  </div>

  @include('front.home._slider')


  @include('front.home._categories')

  @include('front.home._products')

</div>
@endsection
