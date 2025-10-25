<div 
  x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    wraper: {{ json_encode($wraper) }},
    value: {{ json_encode($value) }}, 
    readonly: {{ json_encode($readonly) }},
    required: {{ json_encode($required) }},
    tooltip: {{ json_encode($tooltip) }},
  }"
  class="mb-3 relative"
  :class="wraper">
  <label :for="name"  
    class="block text-sm font-medium text-gray-400 ml-2 mb-1"
    x-text="label">
  </label>
  <input type="datetime-local" 
    :id="name"
    :name="name"
    :readonly="readonly"
    :value="value" 
    :required="required"
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
    text-gray-300 shadow-inner cursor-default focus:outline-none"
    :class="readonly ? 'bg-[#1e293b]' : '' ">
</div>