<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
      crossorigin="anonymous" 
      referrerpolicy="no-referrer"/>
    @vite(['core/resources/css/core.css','core/resources/js/core.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	</head>
	<body class="core-primary-color text-white">
		<div class="flex">
      <aside class="w-64 h-screen bg-[#030712] text-white flex flex-col">
        <div class="flex items-center justify-center h-16 border-b border-gray-700">
          <i class="fa-solid fa-layer-group core-secondary-color text-2xl"></i>
          <span class="core-secondary-color font-bold text-xl">UAR core</span>
        </div>

        <div class="flex flex-col items-center py-4 border-b border-gray-700">
          <div class="flex items-center justify-center text-center">
            <span class="font-semibold break-words leading-tight">
              {{ auth()->user()->first_name }} {{ auth()->user()->sur_name }}
            </span>
          </div>
          <span class="text-sm text-gray-400">
            {{ auth()->user()->type_label }}
          </span>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-6 text-sm">
          <div>
            <h3 class="text-gray-500 uppercase tracking-wide mb-2">Dashboard</h3>
            <a href="#" class="flex items-center px-2 py-2 bg-gray-800 rounded 
              core-secondary-color">
              <span>Dashboard</span>
            </a>
          </div>
            naw elents
        </nav>
      </aside>
			<div class="flex flex-col flex-1">
        <header class="w-full bg-[core-background-color] p-4 shadow flex 
          items-center justify-between text-gray-200">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-layer-group text-white text-2xl"></i>
            <h1 class="text-xl font-semibold">UAR core</h1>
          </div>
          <div class="flex items-center gap-6">

            <button title="Powiadomienia" class="relative hover:text-white">
              <i class="fa-regular fa-bell text-xl"></i>
              <span class="absolute -top-1 -right-1 bg-red-600 text-xs rounded-full px-1">
                3
              </span>
            </button>

            <button title="Ustawienia konta" class="hover:text-white">
              <i class="fa-solid fa-gear text-xl"></i>
            </button>

            <button title="Czat wewnętrzny" class="hover:text-white">
              <i class="fa-solid fa-comments text-xl"></i>
            </button>

            <div class="relative inline-block text-left">
              <button id="userMenuButton" 
                class="w-8 h-8 rounded-full overflow-hidden border 
                border-gray-500 focus:outline-none">
                <img src="https://i.pravatar.cc/40" alt="Avatar" 
                  class="w-full h-full object-cover">
              </button>

              <div id="userDropdown" 
                class="hidden absolute right-0 mt-2 w-48 border border-gray-500 
                core-primary-color rounded-md shadow-lg z-50">

                <a href="/profile" 
                  class="block px-4 py-2 text-sm text-white hover:text-green-400">
                  Ustawienia profilu
                </a>

                <a href="/account/edit" 
                  class="block px-4 py-2 text-sm text-white hover:text-green-400">
                  Zmień dane
                </a>

                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" 
                    class="w-full text-left px-4 py-2 text-sm text-white 
                    hover:text-green-400">Wyloguj się
                  </button>
                </form>
              </div>
            </div>
          </div>
        </header>
				<main class="flex-1 mx-4">
					@yield('content')
				</main>
			</div>
		</div>
		<footer class="bg-[core-background-color] text-gray-400 py-6 text-center 
      border-t border-gray-700">
        <p>
          &copy; 2025 
          <span class="text-white font-semibold">UAR core</span>
          All rights reserved.
        </p>
    </footer>
	</body>
</html>
<script>
  const userBtn = document.getElementById('userMenuButton');
  const dropdown = document.getElementById('userDropdown');

  document.addEventListener('click', function (e) {
    if (userBtn.contains(e.target)) {
      dropdown.classList.toggle('hidden');
    } else if (!dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>