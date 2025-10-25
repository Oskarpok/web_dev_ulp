<div x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    width: {{ json_encode($width) }},
    value: {{ json_encode($value) }}, 
    readonly: {{ json_encode($readonly) }},
    tooltip: {{ json_encode($tooltip) }},
    validation: {{ json_encode($validation) }},
  }"
  class="mb-3 relative"
  :class="width">
  <label :for="name" 
    class="flex text-sm font-medium text-gray-400 ml-2 mb-1 items-center gap-2">
    <span x-text="label"></span>
    <template x-if="tooltip">
      <div class="relative group">
        <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer text-xs">
        </i>
        <div class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max 
          px-2 py-1 bg-gray-800 text-gray-200 text-xs rounded 
          shadow-lg opacity-0 group-hover:opacity-100 transition-opacity text-left">
          <template x-for="line in tooltip.split('|')" :key="line">
            <div x-text="line.trim()"></div>
          </template>
        </div>
      </div>
    </template>
  </label>
  <textarea :id="name"
    :name="name"
    :readonly="readonly"
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 
      py-2 text-gray-300 shadow-inner focus:outline-none" 
    :class="readonly ? 'bg-[#1e293b] cursor-default' : '' "
    x-init="$el.value = JSON.stringify(JSON.parse(value), null, 2)"
    rows="5"></textarea>
</div>