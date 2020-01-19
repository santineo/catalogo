@include('admin.partials._alert')

<div class="card mx-4 rounded-0">
  <div class="card-body">
    <div class="d-flex align-items-center">
      <div class="title mr-auto">{{ $title }}</div>
      @if (isset($crear))
        <a href="{{ route("{$route}.create") }}" class="btn btn-info text-white">Crear {{ $crear }}</a>
      @endif
    </div>

    {{-- Filters --}}
    <form class="form-inline mt-3" action="{{ route("{$route}.index") }}" method="get">
      <div class="form-group mr-sm-3 mb-2">
        <label for="term" class="sr-only">Buscar</label>
        <input type="text" class="form-control" id="term" name="term" placeholder="Término de Búsqueda..." value="{{ request('term', '') }}">
      </div>
      <button type="submit" class="btn btn-primary mb-2 mr-2">Filtrar</button>
      <a href="{{ route("{$route}.index") }}" class="btn btn-success mb-2">Limpiar</a>
    </form>
    @if (request('term'))
      <div class="alert alert-info d-inline-block p-2 mb-0">
        Se han encontrado <span class="font-weight-bold">{{ $values->count() }}</span> {{ $title }} bajo el término de busqueda <span class="font-weight-bold">"{{ request('term') }}"</span>.
      </div>
    @endif
    <div class="">

    </div>

    @if($values->count())
      {{-- Table --}}
      <table class="table table-striped table-bordered mt-2">

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
      <div class="alert alert-warning  mt-4">
        No se han encontrado {{ $title }}
      </div>
    @endif
  </div>
</div>
