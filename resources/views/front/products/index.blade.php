@extends('layouts.front')

@section('content')
  <div class="bg-white" id="productsIndex">


    @include('front.partials.nav')



    <section class="products-index">
      <div class="container">
        <div class="products-index-header row">

          <div class="col-8">
            <h2 class="products-index-header-title">
              {{ isset($category) && $category ? $category->name : 'Nuestro Productos' }}
              <span class="count">({{ $products->total() }})</span>
            </h2>
          </div>

          <div class="col-4">
            <form method="get" action="{{ route('front.products.index', array_merge(request()->all(), ['page' => 1])) }}" class="js_productsFilterForms">
              @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
              @endif
              @if (request('brand'))
                <input type="hidden" name="brand" value="{{ request('brand') }}">
              @endif
              <div class="select-rounded">
                <label>@lang('messages.productsIndex_toShow')</label>
                <select class="custom-select" name="to_show">
                  <option value="30" {{ request('to_show') == '30' ? 'selected' : '' }} >30</option>
                  <option value="60" {{ request('to_show') == '60' ? 'selected' : '' }} >60</option>
                  <option value="90" {{ request('to_show') == '90' ? 'selected' : '' }} >90</option>
                </select>
              </div>

              <div class="select-rounded">
                <label>@lang('messages.productsIndex_order')</label>
                <select class="custom-select" name="order">
                  <option value="popular" {{ request('order') == 'popular' ? 'selected' : '' }}>@lang('messages.productsIndex_popular')</option>
                  <option value="low_price" {{ request('order') == 'low_price' ? 'selected' : '' }}>@lang('messages.productsIndex_lowPrice')</option>
                  <option value="bigger_price" {{ request('order') == 'bigger_price' ? 'selected' : '' }}>@lang('messages.productsIndex_biggerPrice')</option>
                </select>
              </div>

            </form>
          </div>
        </div>

        @include('front.partials.productList')


        {{ $products->appends(request()->all())->links() }}


      </div>
    </section>

  </div>
@endsection
