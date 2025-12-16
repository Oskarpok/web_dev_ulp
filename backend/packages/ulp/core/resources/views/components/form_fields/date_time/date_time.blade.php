<div 
  x-data="{ 
    name: {{ json_encode($name) }},
    value: {{ json_encode($value) }}, 
    readonly: {{ json_encode($readonly) }},
    tooltip: {{ json_encode($tooltip) }},
    validation: {{ json_encode($validation) }},
  }"
  class="mb-3 relative {{ $wraper }}">
  <label :for="name"  
    class="block text-sm font-medium text-gray-400 mb-1">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <input type="datetime-local" 
    :id="name"
    :name="name"
    :readonly="readonly"
    :value="value" 
    @required($required)
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
    text-gray-300 shadow-inner cursor-default focus:outline-none"
    :class="readonly ? 'bg-[#1e293b]' : '' ">
</div>