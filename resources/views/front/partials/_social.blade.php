<div class="d-flex">
  @if ($configs->facebook->value)
  <div><a target="_blank" href="{{ $configs->facebook->value }}" style="font-size: 18px; color: #c5c5c5;"><i class="icon icon-facebook"></i></a></div>
  @endif
  @if ($configs->instagram->value)
  <div><a target="_blank" href="{{ $configs->instagram->value }}" style="margin-left: 33px;font-size: 18px; color: #c5c5c5;"><i class="icon icon-instagram"></i></a></div>
  @endif
  @if ($configs->youtube->value)
  <div><a target="_blank" href="{{ $configs->youtube->value }}" style="margin-left: 33px;font-size: 18px; color: #c5c5c5;"><i class="icon icon-youtube"></i></a></div>
  @endif
  @if ($configs->pinterest->value)
  <div><a target="_blank" href="{{ $configs->pinterest->value }}" style="margin-left: 33px;font-size: 18px; color: #c5c5c5;"><i class="icon icon-pinterest"></i></a></div>
  @endif
  @if ($configs->linkedin->value)
  <div><a target="_blank" href="{{ $configs->linkedin->value }}" style="margin-left: 33px;font-size: 18px; color: #c5c5c5;"><i class="icon icon-linkedin"></i></a></div>
  @endif
</div>
