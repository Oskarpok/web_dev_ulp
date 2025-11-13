<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel Login</title>
  <link rel="stylesheet" 
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
		crossorigin="anonymous" 
		referrerpolicy="no-referrer"/>
  @vite('core/resources/css/core.css')
</head>
<body class="core-background-color min-h-screen flex items-center justify-center">
  <div class="bg-white/5 backdrop-blur-md rounded-2xl shadow-xl p-8 w-full 
    max-w-md border border-white/10">
    <div class="flex items-center justify-center mb-6">
      <i class="fa-solid fa-layer-group core-secondary-color text-4xl"></i>
    </div>
    <h2 class="text-center text-white text-2xl font-bold mb-6">
      Zaloguj się
    </h2>
    @if (session('error'))
      <div class="text-red-500 p-3 rounded mb-4 text-center">
        {{ session('error') }}
      </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-4">
        <label for="login" class="block text-white text-sm mb-2 text-center">
          Login
        </label>
        <input type="text" name="login" class="w-full px-4 py-2 rounded-md 
          border-white/10 focus:ring-green-400 bg-white/10 text-white
          focus:outline-none border focus:ring-2 transition" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-white text-sm mb-2 text-center">
          Hasło
        </label>
        <input type="password" name="password" class="w-full px-4 py-2 rounded-md 
          border-white/10 focus:ring-green-400 bg-white/10 text-white
          focus:outline-none border focus:ring-2 transition" required>
      </div>
      <button type="submit" class="w-full py-2 px-4 core-primary-color rounded-md
        text-white font-semibold hover:bg-gray-800 hover:text-green-400 transition">
        Zaloguj się
      </button>
    </form>
  </div>
</body>
</html>