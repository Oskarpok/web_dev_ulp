<div class="{{ $field->wraper }}">
  <label class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $field->label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $field->tooltip,
    ])
    @endcomponent
  </label>
  <div class="inline-flex items-center py-2.5 my-px">
    <label class="relative {{ $field->disabled ? 'cursor-default' : 'cursor-pointer' }}">
      <input type="hidden" name="{{ $field->name }}" value="0">
      <input type="checkbox"
        name="{{ $field->name }}"
        value="1"
        @checked($field->value)
        @disabled($field->disabled)
        class="sr-only peer">
      <div class="w-11 h-6 bg-[#101828] rounded-full
        transition-all duration-300 peer-disabled:opacity-40">
      </div>
      <div class="absolute left-0.5 top-0.5 w-5 h-5 rounded-full transition-all 
        duration-300 peer-checked:translate-x-full {{ $field->disabled ? 
        'bg-[#9fabbe]' : 'bg-red-500 peer-checked:bg-green-400' }}">
      </div>
    </label>
  </div>
</div>