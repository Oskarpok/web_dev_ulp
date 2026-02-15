<div class="{{ $field->wraper }}">
  <label for="{{ $field->name }}"
    class="block text-sm font-medium text-gray-400 mb-1">
    <span>{{ $field->label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $field->tooltip,
    ])
    @endcomponent
  </label>
  @error('state.' . $field->name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
  <input type="datetime-local" 
    name="{{ $field->name }}"
    value="{{ $field->value }}"
    @readonly($field->readonly)
    @required($field->required)
    @disabled($field->disabled)
    wire:model.blur="state.{{ $field->name }}"
    @class([
      'mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 shadow-inner focus:outline-none',
      'bg-[#1e293b] cursor-default' => $field->readonly,
      'border-red-500' => $errors->has('state.' . $field->name),
      'border-gray-600' => ! $errors->has('state.' . $field->name),
    ])
  >
</div>