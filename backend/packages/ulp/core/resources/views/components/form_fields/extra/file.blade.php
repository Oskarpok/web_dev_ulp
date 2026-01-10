<div class="{{ $wraper }}">
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
  <input type="file"
    name="{{ $name }}"
    accept="{{ $accept }}"
    @disabled($disabled)
    @required($required)
    @if($multiple) multiple @endif
    {{-- Livewire --}}
    wire:model="{{ $multiple ? 'state.' . $name : 'state.' . $name }}"
    @class([
      'mt-1 w-full border rounded-xl px-3 py-2 text-gray-300 shadow-inner 
      focus:outline-none text-sm file:mr-4 file:py-0.5 file:px-3 file:rounded-xl 
      file:border-0 file:text-sm file:font-semibold file:bg-[#1e293b] 
      file:text-gray-200 hover:file:bg-gray-700 file:cursor-pointer 
      pointer-events-none file:pointer-events-auto',
      'cursor-not-allowed opacity-60' => $disabled,
      'border-red-500' => $errors->has('state.' . $name),
      'border-gray-600' => ! $errors->has('state.' . $name),
    ])
  >
</div>