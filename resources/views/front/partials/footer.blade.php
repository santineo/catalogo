<div class="bg-white">
  <footer class="container border-top" style="padding: 55px 0">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <h2 class="text-primary" style="font-size: 19px; font-weight:500; margin-bottom: 42px;">{{ $configs->site_name->value }}</h2>
        <p style="color:#808080; font-size: 13px; line-height: 2; margin-bottom: 27px">{{ $configs->description->value }}</p>

        @include('front.partials._social')
      </div>
      <div class="col-lg-4 col-md-6 ml-auto">
        <div class="d-flex justify-content-between">

          <div>
            <h4 style="margin-bottom: 30px; font-size:14px; font-weight:600;" class="text-primary">Tienda</h4>
            <ul class="list-unstyled">
              @foreach (App\Category::take(4)->get() as $key => $category)
                <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;" ><a href="{{ route('front.products.index', ['category' => $category->id]) }}" class="text-dark">{{ Str::limit($category->name, 20) }}</a></li>
              @endforeach
            </ul>
          </div>

          @if ($configs->email->value || $configs->phone->value)
            <div>
              <h4 style="margin-bottom: 30px; font-size:14px; font-weight:600;" class="text-primary">Contacto</h4>
              <ul class="list-unstyled">
                @if ($configs->email->value)
                  <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;"><a href="mailto:{{ $configs->email->value }}" class="text-dark">{{ $configs->email->value }}</a></li>
                @endif
                @if ($configs->phone->value)
                  <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;">Tel: <a href="tel:{{ $configs->phone->value }}" class="text-dark">{{ $configs->phone->value }}</a></li>
                @endif
              </ul>
            </div>
          @endif

        </div>
      </div>
    </div>
  </footer>

</div>
