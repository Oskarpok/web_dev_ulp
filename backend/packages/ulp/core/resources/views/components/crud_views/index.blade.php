@extends('cms::layouts.app')
@section('content')
<div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
  <div class="flex items-center justify-between mb-6 p-4 
    bg-[cms-background-color] rounded-lg shadow">
      <h1 class="text-xl font-semibold py-2">
        {!! $title !!}
      </h1>
      flasss message 
      <div class="flex gap-x-2">
        @foreach($buttons as $button)     
          @continue(is_null($button))   
          {!! $button->render() !!}
        @endforeach
      </div>
  </div>
  <div class="overflow-x-auto">
    {!! $table->render() !!}
  </div>
</div>
@endsection