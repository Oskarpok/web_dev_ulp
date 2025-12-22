<a id ="{{ $name }}"
  class="core-btn {{ $readonly ? 'core-btn-readonly' : $style }}"
  href="{{ $readonly ? '#' : $route }}"
  @if($readonly) aria-disabled="true" @endif>
  <i class="{{ $icone }}"></i>
  <span>{{ $label }}</span>
</a>