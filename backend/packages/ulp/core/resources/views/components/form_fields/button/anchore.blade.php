<a id ="{{ $name }}"
  class="core-btn {{ $disabled ? 'core-btn-readonly' : $style }}"
  href="{{ $disabled ? '#' : $route }}"
  @if($disabled) aria-disabled="true" @endif>
  <i class="{{ $icone }}"></i>
  <span>{{ $label }}</span>
</a>