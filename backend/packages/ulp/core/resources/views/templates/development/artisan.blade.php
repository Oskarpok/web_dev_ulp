@extends('core::layouts.app')
@section('content')
<div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
  <div class="flex items-center justify-between mb-6 p-4 bg-[cms-background-color] rounded-lg shadow">
    <h1 class="text-xl font-semibold py-2">Panel Artisan projektu</h1>
  </div>
  <div class="space-y-4">
    <div class="flex gap-6">
      @foreach ($buttons as $buttons)
        @continue(is_null($buttons))
        {!! $buttons->render() !!}
      @endforeach
    </div>
  </div>
</div>
@endsection 