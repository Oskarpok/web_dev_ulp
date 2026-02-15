@extends('core::layouts.app')
@section('content')
<div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
  <div class="flex items-center justify-between mb-6 p-4 
    bg-[core-background-color] rounded-lg shadow">
    <h1 class="text-xl font-semibold py-2">
      {!! $title !!}
    </h1>
    <div class="flex gap-x-2">
      @foreach($buttons as $button)
        @continue(is_null($button))
        {!! $button->render() !!}
      @endforeach
    </div>
  </div>
  <livewire:form-fields.form-component
    :fields="$fields"
    :validationRules="$validationRules"
    :action="$route"
    :data="$data"
    httpMethod=""
  />
</div>
@endsection 