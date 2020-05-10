@extends('emails._layout')

@section('content')
  @foreach ($products as $key => $product)

    @if ($key % 2 == 0)
      <table class="row" style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
        <tbody>
          <tr style="padding:0;text-align:left;vertical-align:top">
          @endif

          @include('emails._product', ['class' => $key % 2 == 0 ? 'first' : 'last', 'product' => $product])

          @if ($key % 2 == 0 && !$products->has(($key + 1)))
            @include('emails._product', ['class' => 'last', 'product' => false])
          @endif

          @if ($key % 2 != 0 || !$products->has(($key + 1)))
          </tr>
        </tbody>
      </table>
    @endif


  @endforeach
@endsection
