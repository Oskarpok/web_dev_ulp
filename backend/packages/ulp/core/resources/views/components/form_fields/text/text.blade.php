<div class="mb-3 relative {{ $wraper }}">
  <label for="{{ $name }}" 
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>

  <livewire:form-fields.validation />

  <input type="text" 
    value="{{ $value }}"
    name="{{ $name }}"
    @readonly($readonly)
    @required($required)
    @disabled($disabled)
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
      text-gray-300 shadow-inner focus:outline-none
      {{ $readonly ? 'bg-[#1e293b] cursor-default' : '' }}">
</div>