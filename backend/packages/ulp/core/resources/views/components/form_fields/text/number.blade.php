<style>
  /* Chrome, Safari, Edge, Opera */
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<div 
  x-data="{ 
    label: {{ json_encode($label) }},
    name: {{ json_encode($name) }},
    wraper: {{ json_encode($wraper) }},
    value: {{ json_encode($value) }},
    step: {{ json_encode($step) }}, 
    readonly: {{ json_encode($readonly) }},
    required: {{ json_encode($required) }},
    max: {{ json_encode($max) }},
    min: {{ json_encode($min) }},
    allowFloat: {{ json_encode($allow_float) }},
    validation: {{ json_encode($validation) }},
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
  <div class="flex items-center border border-gray-600 rounded-xl 
    shadow-inner mt-1"
    :class="[
      readonly ? 'bg-[#1e293b]' : '',
      false ? 'border-red-500' : 'border-gray-600',
    ]">
    <input type="text"
      x-model="value"
      class="w-full bg-transparent text-gray-300 px-3 py-2 rounded-l-xl 
        focus:outline-none"
      :class="readonly ? 'cursor-default' : ''"
      :id="name"
      :name="name"
      :readonly="readonly"
      :required="required"
      :max="max"
      :min="min"
      inputmode="decimal"
      @keydown="
        const key = $event.key;
        const value = $event.target.value;
        const caret = $event.target.selectionStart ?? 0;
        const isNumber = /^[0-9]$/.test(key);
        const allowed = ['Backspace', 'Tab', 'ArrowLeft', 'ArrowRight', 'Delete'];

        if (!allowed.includes(key) && !isNumber && key !== '.' && key !== '-') {
          $event.preventDefault();
        }

        if (key === '.') {
          if (value.includes('.') || caret === 0 || !allowFloat) {
            $event.preventDefault();
          }
        }

        if (key === '-') {
          if (value.includes('-') || caret !== 0) {
            $event.preventDefault();
          }
        }
      "
    />
    <div class="flex flex-col">
      <button type="button"
        @click="value += step"
        class="text-[#898d95] px-1 py-0.5 text-xs rounded-tr-xl"
        :class="readonly ? 'cursor-default' : 'hover:text-[#d1d5dc]' "
        aria-label="Increment"
        :disabled="readonly">
        ▲
      </button>
      <button type="button"
        @click="value -= step"
        class="text-[#898d95] px-1 py-0.4 text-xs rounded-br-xl"
        :class="readonly ? 'cursor-default' : 'hover:text-[#d1d5dc]' "
        aria-label="Decrement"
        :disabled="readonly">
        ▼
      </button>
    </div>
  </div>
</div>