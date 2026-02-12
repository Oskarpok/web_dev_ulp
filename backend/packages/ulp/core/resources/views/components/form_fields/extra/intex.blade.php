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
          @foreach($row['buttons'] as $button)
            {!! $button->render() !!}
          @endforeach
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="custom-pagination mt-3">
  {{ $data->links() }}
  <div class="goto-page">
    <input type="text" id="pageJumpInput">
    <button onclick="jumpToPage()">GO</button>
  </div>
</div>

<script>
  function jumpToPage() {
      const page = document.getElementById('pageJumpInput').value;
      if (page && page > 0) {
          const url = new URL(window.location.href);
          url.searchParams.set('page', page);
          window.location.href = url.href;
      }
  }

  document.getElementById('pageJumpInput').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
          jumpToPage();
      }
  });
</script>

<style>
  /* KONTENER GŁÓWNY - TRZYMA WSZYSTKO W JEDNEJ LINII */
  .custom-pagination {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: center !important;
    flex-wrap: wrap; /* W razie bardzo wielu stron zawinie do nowej linii na telefonie */
    gap: 10px;
  }

  /* SEKCIJA SKOKU DO STRONY */
  .goto-page {
    margin-top: 0 !important; /* Usuwamy margines, by wyrównać do środka */
    display: flex;
    align-items: center;
    gap: 5px;
  }

  #pageJumpInput {
    background-color: #0f172a;
    border: 1px solid #1e293b;
    color: white;
    padding: 6px;
    border-radius: 6px;
    width: 67px; /* POMNIEJSZONY INPUT */
    outline: none;
    text-align: center;
  }

  /* Usuwamy strzałki wewnątrz inputa typu number dla czystszego wyglądu */
  #pageJumpInput::-webkit-outer-spin-button,
  #pageJumpInput::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .goto-page button {
    background-color: #059669;
    color: white;
    border: none;
    padding: 7px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s;
  }

  .goto-page button:hover {
    background-color: #047857;
  }

  /* TWOJE ISTNIEJĄCE STYLE PAGINACJI */
  .custom-pagination nav svg {
    width: 20px !important;
    height: 20px !important;
    display: inline-block !important;
  }

  .custom-pagination nav .hidden.sm\:flex-1 {
    display: flex !important;
    align-items: center !important;
  }

  .custom-pagination nav .hidden.sm\:flex-1 > div:first-child {
    display: none !important;
  }

  .custom-pagination nav a {
    background-color: #0f172a !important;
    color: white !important;
    padding: 8px 14px !important;
    margin: 0 3px !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    display: inline-flex !important;
  }

  .custom-pagination nav span[aria-current="page"] span {
    background-color: #059669 !important;
    color: white !important;
    padding: 8px 14px !important;
    margin: 0 3px !important;
    border-radius: 6px !important;
    font-weight: bold;
  }

  .custom-pagination nav span[aria-disabled="true"] span {
    background-color: #0f172a !important;
    color: #10b981 !important;
    padding: 8px 14px !important;
    margin: 0 3px !important;
    border-radius: 6px !important;
    opacity: 0.6;
  }

  .custom-pagination nav .shadow-sm {
    box-shadow: none !important;
    border: none !important;
    display: flex !important;
    align-items: center !important;
  }

  /* HOVER - tylko dla linków */
  .custom-pagination nav a:hover {
    background-color: #047857 !important; /* emerald-700 */
  }

  /* Ukrycie wersji mobilnej Laravela */
  .custom-pagination nav .flex.justify-between.flex-1.sm\:hidden {
    display: none !important;
  }
</style>