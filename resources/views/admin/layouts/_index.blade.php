<div class="card mx-4 rounded-0">
  <div class="card-body">
    <div class="title">{{ $title }}</div>

    {{-- Filters --}}
    <form class="form-inline mt-3" action="{{ route("{$route}.index") }}" method="get">
      <div class="form-group mr-sm-3 mb-2">
        <label for="term" class="sr-only">Buscar</label>
        <input type="text" class="form-control" id="term" placeholder="Término de Búsqueda...">
      </div>
      <button type="submit" class="btn btn-primary mb-2 mr-2">Filtrar</button>
      <a href="{{ route("{$route}.index") }}" class="btn btn-success mb-2">Limpiar</a>
    </form>

    @if($values->count())
    {{-- Table --}}
    <table class="table mt-4">

      <thead class="thead-dark">
        <tr>
          @foreach ($attributes as $attribute)
            <th scope="col">{{ $attribute['label'] }}</th>
          @endforeach
        </tr>
      </thead>

      <tbody>
        @foreach ($values as $value)
        <tr>
          @foreach ($attributes as $attribute)
            <td>{!! $value->{$attribute['slug']} !!}</td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info  mt-4">
      No se han encontrado {{ $title }}
    </div>
  @endif
  </div>
</div>
