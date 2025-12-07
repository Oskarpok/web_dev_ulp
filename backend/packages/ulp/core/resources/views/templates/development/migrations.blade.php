@extends('core::layouts.app')
@section('content')
<div class="bg-gray-950 p-6 text-gray-200 rounded-2xl">
  <div class="flex items-center justify-between mb-6 p-4 
    bg-[cms-background-color] rounded-lg shadow">
    <h1 class="text-xl font-semibold py-2">Panel migracji</h1>
    {!! $button->render() !!}
  </div>
  <div class="overflow-x-auto">
    <table class="w-full table-auto border border-gray-700 text-left 
      overflow-hidden">
      <thead class="bg-gray-800 text-gray-300">
        <tr>
          <th class="px-4 py-3 border border-gray-700">Package</th>
          <th class="px-4 py-3 border border-gray-700">Migrations</th>
          <th class="w-10 px-4 py-3 border border-gray-700">Done</th>
        </tr>
      </thead>
      <tbody>
        @foreach($migrations as $migration)
          <tr class="hover:bg-gray-800">
            <td class="px-4 py-2 border border-gray-700">
              {{ $migration['package'] }}
            </td>
            <td class="px-4 py-2 border border-gray-700">
              {{ $migration['name'] }}
            </td>
            <td class="px-4 py-2 border border-gray-700 text-center 
              align-middle">
              {!! $migration['batch'] 
                ? '<i class="fa-solid fa-check text-sky-400"></i>' 
                : '<i class="fa-solid fa-xmark text-rose-500"></i>' 
              !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection 