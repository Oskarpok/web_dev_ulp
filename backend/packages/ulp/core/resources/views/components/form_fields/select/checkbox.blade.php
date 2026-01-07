<div class="{{ $wraper }}">
  <label class="flex text-sm font-medium text-gray-400 mb-1 items-center gap-2">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  <div class="inline-flex items-center py-2.5">
    <label class="relative {{ $disabled ? 'cursor-default' : 'cursor-pointer' }}">
      <input type="hidden" name="{{ $name }}" value="0">
      <input type="checkbox"
        name="{{ $name }}"
        value="1"
        @checked($value)
        @disabled($disabled)
        class="sr-only peer">
      <div class="w-11 h-6 bg-[#101828] rounded-full
        transition-all duration-300 peer-disabled:opacity-40">
      </div>
      <div class="absolute left-0.5 top-0.5 w-5 h-5 rounded-full transition-all 
        duration-300 peer-checked:translate-x-full {{ $disabled ? 
        'bg-[#9fabbe]' : 'bg-red-500 peer-checked:bg-green-400' }}">
      </div>
    </label>
  </div>
</div>