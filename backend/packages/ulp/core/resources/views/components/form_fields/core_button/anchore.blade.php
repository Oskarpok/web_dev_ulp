<a 
  x-data="{
    name: {{ json_encode($name) }},
    label: {{ json_encode($label) }},
    icone: {{ json_encode($icone) }},
    readonly: {{ $readonly ? 'true' : 'false' }},
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
  <span x-text="label"></span>
</a>