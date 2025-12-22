<div class="mb-3 relative {{ $wraper }}">
  <label class="block text-sm font-medium text-gray-400 mb-1">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <input type="datetime-local" 
    name="{{ $name }}"
    @readonly($readonly)
    @required($required)
    value="{{ $value }}"
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
    text-gray-300 shadow-inner cursor-default focus:outline-none
      {{ $readonly ? 'bg-[#1e293b]' : '' }}">
</div>