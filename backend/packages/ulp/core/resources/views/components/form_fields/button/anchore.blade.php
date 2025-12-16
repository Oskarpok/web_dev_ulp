<a 
  x-data="{
    name: {{ json_encode($name) }},
    icone: {{ json_encode($icone) }},
    readonly: {{ json_encode($readonly) }},
    style: {{ $style }},
    getButtonClass() {
      const styles = [
        'core-btn-primary',
        'core-btn-secondary',
        'core-btn-background',
        'core-btn-outline'
      ];
      return styles[this.style] || styles[0];
    }
  }"
  :name="name"
  :class="['core-btn', readonly ? 'core-btn-readonly' : getButtonClass()]"
  href="{{ $route }}">
  <i :class="icone"></i>
  <span>{{ $label }}</span>
</a>