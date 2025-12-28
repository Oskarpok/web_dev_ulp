<button id ="{{ $name }}"
  type="submit"
  class="core-btn {{ $disabled ? 'core-btn-readonly' : $style }}"
  @disabled($disabled)>
  <i class="{{ $icone }}"></i>
  <span>{{ $label }}</span>
</button>