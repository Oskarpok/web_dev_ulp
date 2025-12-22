<button id ="{{ $name }}"
  type="submit"
  class="core-btn {{ $readonly ? 'core-btn-readonly' : $style }}"
  @disabled($readonly)>
  <i class="{{ $icone }}"></i>
  <span>{{ $label }}</span>
</button>