<div x-data="{ 
    value: {{ json_encode($field->value) }}, 
    formatValue() {
      try {
        return JSON.stringify(JSON.parse(this.value), null, 2);
      } catch (e) {
        return this.value;
      }
    }
  }"
  class="{{ $field->wraper }}">
  <label for="{{ $field->name }}" 
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $field->label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $field->tooltip,
    ])
    @endcomponent
  </label>
  <textarea name="{{ $field->name }}"
    @readonly($field->readonly)
    @required($field->required)
    @disabled($field->disabled)
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 
      py-2 text-gray-300 shadow-inner focus:outline-none
      {{ $field->readonly ? 'bg-[#1e293b] cursor-default' : '' }}" 
    x-init="$el.value = formatValue()"
    rows="5"></textarea>
</div>