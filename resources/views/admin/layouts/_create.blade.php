@include('admin.partials._alert')

<div class="card mx-4 rounded-0">
  <div class="card-body">
    <div class="title">Crear {{ $title }}</div>
    <hr>
    <form action="{{ route("{$route}.store") }}" method="post">
      @csrf
      @include($form)
      <button type="submit" class="btn btn-success mt-2">Crear</button>
    </form>
  </div>
</div>
