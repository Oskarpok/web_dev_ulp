<div x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    wraper: {{ json_encode($wraper) }},
    value: {{ json_encode($value) }}, 
    readonly: {{ json_encode($readonly) }},
    required: {{ json_encode($required) }},
  }"
  class="mb-3 relative"
  :class="wraper">
  <label :for="name" 
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span x-text="label"></span>
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
    :required="required"
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
      text-gray-300 shadow-inner focus:outline-none"
    :class="[
      readonly ? 'bg-[#1e293b]' : '',
      false ? 'border-red-500' : 'border-gray-600',
    ]"
  >
</div>