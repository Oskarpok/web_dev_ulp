<form @isset($formId) id="{{ $formId }}" @endisset
  method="{{ $this->formMethod() }}" 
  action="{{ $action }}"
  @if($enctype) enctype="multipart/form-data" @endif >
  @csrf
  @if($spm) @method($spm) @endif
  <div class="w-full mx-auto p-6 shadow rounded-2xl space-y-6 text-gray-200 
    border border-gray-600 flex flex-wrap gap-5 place-items-center">
    @foreach ($fields as $field)
      @include($field->view, ['field' => $field]) 
    @endforeach
  </div>
</form>