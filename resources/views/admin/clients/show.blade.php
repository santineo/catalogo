<div class="contact-content">
  <div class="mb-1">
    <strong>Nombre:</strong>
  </div>
  <p>{{ $client->name }}</p>
  <div class="mb-1">
    <strong>Email:</strong>
  </div>
  <p>{{ $client->email }}</p>
  <div class="mb-1">
    <strong>Teléfono:</strong>
  </div>
  <p>{{ $client->phone }}</p>
  <div class="mb-1">
    <strong>Mensaje:</strong>
  </div>
  <p>{{ $client->information ?: '-' }}</p>

  @if ($client->groups->count())
  <div class="mb-1">
    <strong>Se encuentra en los grupos:</strong>
  </div>
  <ul class="list-inline">
  @foreach ($client->groups as $key => $group)
      <li class="list-inline-item border py-1 px-2 rounded bg-primary text-light">{{ $group->name }}</li>
  @endforeach
</ul>
@endif
</div>
