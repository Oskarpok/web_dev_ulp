@extends('core::layouts.app')
@section('content')
<div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
  <div class="flex items-center justify-between mb-6 p-4 
    bg-[core-background-color] rounded-lg shadow">
    <h1 class="text-xl font-semibold py-2">
      {!! $title !!}
    </h1>
    <div class="flex gap-x-2">
      @foreach ($controls['buttons'] as $button)
        {!! $button->render() !!}
      @endforeach
    </div>
  </div>
  <div class="w-full mx-auto text-gray-200 border border-gray-600 p-6 
    shadow rounded-2xl space-y-6 flex flex-wrap gap-5 place-items-center">
    @foreach ($controls['fields'] as $field)
      {!! $field->render() !!}
    @endforeach
  </div>
</div>
@endsection 