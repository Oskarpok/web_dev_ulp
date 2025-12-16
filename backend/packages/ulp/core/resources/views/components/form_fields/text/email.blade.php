<div x-data="{ 
    name: {{ json_encode($name) }},
    value: {{ json_encode($value) }}, 
    readonly: {{ json_encode($readonly) }},
  }"
  class="mb-3 relative {{ $wraper }}">
  <label :for="name" 
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <input type="email" 
    x-model="value"
    :id="name"
    :name="name"
    :readonly="readonly"
    @required($required)
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
      text-gray-300 shadow-inner focus:outline-none"
    :class="[
      readonly ? 'bg-[#1e293b]' : '',
      false ? 'border-red-500' : 'border-gray-600',
    ]"
  >
</div>