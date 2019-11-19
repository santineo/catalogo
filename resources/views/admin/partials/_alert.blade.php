@if (session('info'))
  <div class="alert alert-{{ session('alert') ?: 'info' }} mx-4">
    {!! session('info') !!}
  </div>
@endif

@if($errors->any())
  <div class="alert alert-danger mx-4">
    @foreach ($errors->all() as $key => $error)
      <p class="m-0">{!! $error !!}</p>
    @endforeach
  </div>
@endif
