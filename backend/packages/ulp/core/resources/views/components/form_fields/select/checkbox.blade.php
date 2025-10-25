<div x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    width: {{ json_encode($width) }},
    value: {{ json_encode($value) }},
    readonly: {{ json_encode($readonly) }},
    tooltip: {{ json_encode($tooltip) }},
  }"
  class="mb-3 relative" :class="width">
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