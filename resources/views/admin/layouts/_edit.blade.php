@include('admin.partials._alert')

<div class="card mx-4 rounded-0">
  <div class="card-body">
    <div class="title small">Edición de <strong class="text-success">{{ $title }}</strong></div>
    <hr>
    <form action="{{ route("{$route}.update", $model) }}" method="post">
      @csrf
      @method('PUT')
      @include($form)
      <button type="submit" class="btn btn-success mt-2">Guardar</button>
    </form>
  </div>
</div>
