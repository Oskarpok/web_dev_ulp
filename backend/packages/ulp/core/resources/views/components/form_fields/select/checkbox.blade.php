<div x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    wraper: {{ json_encode($wraper) }},
    value: {{ json_encode($value) }},
    readonly: {{ json_encode($readonly) }},
  }"
  class="mb-3 relative" :class="wraper">
  <label :for="name" 
    class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
    <span x-text="label"></span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <label class="inline-flex items-center cursor-pointer ml-2 mt-1 mb-4.5">
    <div class="relative">
      <input type="checkbox"
        :id="name"
        @change="value = $event.target.checked ? 1 : 0"
        :checked="value == 1"
        :disabled="readonly"
        class="sr-only peer">
      <div class="w-11 h-6 bg-[#101828] peer-focus:outline-none 
        rounded-full peer peer-disabled:opacity-40 peer-disabled:cursor-not-allowed 
        transition-all duration-300">
      </div>
      <div class="absolute left-0.5 top-0.5 w-5 h-5 rounded-full 
        transition-all duration-300 
        peer-checked:bg-green-400 
        bg-red-500
        peer-checked:translate-x-full">
      </div>
    </div>
  </label>
  <input type="hidden" :name="name" :value="value">
</div>