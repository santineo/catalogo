<div class="social">
  @if ($configs->facebook->value)
      <a target="_blank" class="social-item" href="{{ $configs->facebook->value }}">
        <i class="icon icon-facebook"></i>
        <span class="sr-only">@lang('messages.social_facebook')</span>
      </a>
  @endif

  @if ($configs->instagram->value)
      <a target="_blank" class="social-item" href="{{ $configs->instagram->value }}">
        <i class="icon icon-instagram"></i>
        <span class="sr-only">@lang('messages.social_instagram')</span>
      </a>
  @endif

  @if ($configs->youtube->value)
      <a target="_blank" class="social-item" href="{{ $configs->youtube->value }}">
        <i class="icon icon-youtube"></i>
        <span class="sr-only">@lang('messages.social_youtube')</span>
      </a>
  @endif

  @if ($configs->pinterest->value)
      <a target="_blank" class="social-item" href="{{ $configs->pinterest->value }}">
        <i class="icon icon-pinterest"></i>
        <span class="sr-only">@lang('messages.social_pinterest')</span>
      </a>
  @endif

  @if ($configs->linkedin->value)
      <a target="_blank" class="social-item" href="{{ $configs->linkedin->value }}">
        <i class="icon icon-linkedin"></i>
        <span class="sr-only">@lang('messages.social_linkedin')</span>
      </a>
  @endif
</div>
