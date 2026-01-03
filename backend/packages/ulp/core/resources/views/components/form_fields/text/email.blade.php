<div class="mb-3 relative {{ $wraper }}">
  <label for="{{ $name }}"
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  @error('state.' . $name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
  <input type="email" 
    value="{{ $value }}"
    name="{{ $name }}""
    @readonly($readonly)
    @required($required)
    @disabled($disabled)
    wire:model.blur="state.{{ $name }}"
    @class([
      'mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 shadow-inner focus:outline-none',
      'bg-[#1e293b] cursor-default' => $readonly,
      'border-red-500' => $errors->has('state.' . $name),
      'border-gray-600' => ! $errors->has('state.' . $name),
    ])
  >
</div>