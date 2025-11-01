@props([
  'tooltip' => ''
])

@if(!empty($tooltip))
<div class="relative group">
  <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer text-xs"></i>
  <div class="absolute top-1/2 left-full ml-2 -translate-y-1/2 z-10 w-max 
    px-2 py-1 bg-gray-800 text-gray-200 text-xs rounded shadow-lg 
    opacity-0 group-hover:opacity-100 transition-opacity text-left">
    <template x-for="line in '{{ $tooltip }}'.split('|')" :key="line">
      <div x-text="line.trim()"></div>
    </template>
  </div>
</div>
@endif