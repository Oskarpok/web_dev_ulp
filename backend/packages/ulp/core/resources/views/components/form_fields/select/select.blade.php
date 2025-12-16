<div 
  x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    value: {{ json_encode($value) }},
    options: {{ json_encode($options) }},
    readonly: {{ json_encode($readonly) }},
    required: {{ json_encode($required) }},
    searchable: {{ json_encode($searchable) }},
    multiple: {{ json_encode($multiple) }},
    searchTerm: '',
    open: false,
    filteredOptions() {
      if (!this.searchable || !this.searchTerm) return this.options;
      const term = this.searchTerm.toLowerCase();
      return Object.fromEntries(
        Object.entries(this.options).filter(([key, label]) =>
          label.toLowerCase().includes(term)
        )
      );
    }
  }" 
  class="mb-3 relative {{ $wraper }}">
  <label :for="name" 
    class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span x-text="label"></span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <button type="button"
    @click="if (!readonly) { open = !open; searchTerm = '' }"
    class="mt-1 w-full border border-gray-600 rounded-xl px-3 py-2 
    text-gray-300 shadow-inner text-left"
    :class="readonly ? 'bg-[#1e293b] cursor-default' : '' ">
    <span x-text="options[value] ?? 'Wybierz opcję'"></span>
  </button>
  <div x-show="open"
    @click.away="open = false"
    class="absolute z-10 mt-20 w-full cms-primary-color border border-gray-700 
      rounded-xl text-gray-100 shadow-lg max-h-64 overflow-auto p-2 bg-[#0f172a]">
    <template x-if="searchable">
      <input type="text"
        x-model="searchTerm"
        class="w-full mb-2 px-3 py-2 rounded-md bg-gray-800 border 
          border-gray-600 text-sm text-white focus:outline-none">
    </template>
    <ul>
      <template x-for="(label, key) in filteredOptions()" :key="key">
        <li>
          <button type="button"
            :disabled="readonly"
            class="w-full text-left px-3 py-2 hover:bg-gray-600 rounded"
            @click="if (!readonly) 
              { value = key; open = false; $refs.hidden.value = key }"
            x-text="label">
          </button>
        </li>
      </template>
      <template x-if="Object.keys(filteredOptions()).length === 0">
        <li class="text-gray-400 px-3 py-2 text-sm italic">Brak wyników</li>
      </template>
    </ul>
  </div>
  <input type="hidden" 
    :id="name"
    :name="name"
    :value="value" 
    x-ref="hidden">
</div>