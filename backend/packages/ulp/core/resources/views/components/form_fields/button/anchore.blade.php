<a id="{{ $name }}"
  class="{{ ($disabled || empty($routeName)) ? 'core-btn-readonly' : $style }}"
  href="{{ ($disabled || empty($routeName)) ? '#' : route($routeName, $routeParams)}}"
  @if($disabled || empty($routeName)) aria-disabled="true" @endif>
  <i class="{{ $icone }}"></i>
  <span>{{ $label }}</span>
</a>