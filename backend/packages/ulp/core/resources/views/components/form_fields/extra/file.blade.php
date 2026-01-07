<div class="{{ $wraper }}">
  <label for="{{ $name }}"
    class="block text-sm font-medium text-gray-400 mb-1">
    <span>{{ $label }}</span>
    @component('core::components.form_fields.helpers.tooltip', [
      'tooltip' => $tooltip,
    ])
    @endcomponent
  </label>
  @error('state.' . $name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
  <input type="file">
</div>