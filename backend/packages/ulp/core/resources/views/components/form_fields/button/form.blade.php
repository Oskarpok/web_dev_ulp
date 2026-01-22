<form id="{{ $name }}"
  class="inline {{ ($disabled || empty($routeName)) ? 'core-btn-readonly' : $style }}"
  action="{{ ($disabled || empty($routeName)) ? '#' : route($routeName, $routeParams)}}" 
  method="POST" 
  onsubmit="return confirm('Na pewno chcesz usunąć?')" >
  @csrf
  @method('DELETE')
  <button class="text-rose-500 hover:text-rose-400"
    type="submit" 
    title="Usuń">
      <i class="{{ $icone }}"></i>
  </button>
</form>