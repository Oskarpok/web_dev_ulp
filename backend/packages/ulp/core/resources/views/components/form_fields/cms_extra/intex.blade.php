<table class="w-full table-auto border border-gray-700 text-left overflow-hidden">
  <thead class="text-gray-300">
    <tr class="bg-gray-900 text-sm font-semibold uppercase tracking-wider">
      @foreach($labels as $label)
        <th class="px-4 py-3 border border-gray-700"> {!! $label !!}</th>
      @endforeach
      <th class="px-4 py-3 border border-gray-700">Actions</th>
    </tr>
    <tr>
      <form action="{{ route($destinations . 'index') }}"  
        id="filtersForm"  method="GET">
        @foreach($filterable as $key => $val)
          <th class="px-2 py-2 border border-gray-700">
            <input type="text"
              name="{{ $key }}"
              value="{{ request($key) }}"
              {{ $val ? '' : 'disabled' }}
              class="w-full px-3 py-2 text-sm rounded-md 
              text-white bg-gray-900 placeholder-gray-400 border 
              border-gray-600 focus:outline-none focus:ring-2 
              focus:ring-blue-500 disabled:cursor-not-allowed disabled:opacity-50">
          </th>
        @endforeach
        <th class="px-2 py-2 border border-gray-700 text-center">
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 
              py-2 rounded-md focus:outline-none focus:ring-2 
            focus:ring-blue-400 focus:ring-offset-1">
            Filtruj
          </button>
        </th>
      </form>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      <tr class="hover:bg-gray-800">
        @foreach($filterable as $key => $val)
          <td class="px-3 py-2 border border-gray-700">
            {{ $row[$key . '_label'] ?? $row[$key] }}
          </td>
        @endforeach
        <td class="w-27 px-4 py-2 border border-gray-700 text-center space-x-2">
          <a href="{{ route($destinations . 'show', $row['id']) }}" title="Zobacz">
            <i class="fa-solid fa-eye text-sky-400 hover:text-sky-300"></i>
          </a>
          <a href="{{ route($destinations . 'edit', $row['id']) }}" title="Edytuj">
            <i class="fas fa-edit text-yellow-400 hover:text-yellow-300"></i>
          </a> 
          <form action="{{ route($destinations . 'destroy', $row['id']) }}" 
            method="POST" 
            onsubmit="return confirm('Na pewno chcesz usunąć?')" 
            class="inline">
            @csrf
            @method('DELETE')
            <button class="text-rose-500 hover:text-rose-400"
              type="submit" 
              title="Usuń">
                <i class="fas fa-trash-alt"></i>
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>