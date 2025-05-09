<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>@yield('title', 'Gym Management System')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="relative min-h-screen">
  <img src="/images/logo.png" class="absolute object-fill w-full h-full" alt="background image" />
  <!-- Your content here -->
  <div class="absolute top-5 right-5 flex flex-row space-x-10 z-50">
    <a href="#" class="text-white text-lg font-semibold hover:underline">Get Membership</a>
    <a href="success" class="text-white text-lg font-semibold hover:underline">Success Stories</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">About</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">Services</a>
    <a href="{{ route('user.classes.index') }}" class="text-white text-lg font-semibold hover:underline">Available Classes</a>
    <!-- <a href="#" class="text-white text-lg font-semibold hover:underline">Buy Gym Equipments</a> -->
    <!-- Notification -->
    <a href="{{ route('notifications.index') }}" class="text-white text-lg font-semibold hover:underline relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @php
            $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->count();
        @endphp
        @if($unreadCount > 0)
            <span class="absolute -top-2 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </a>
    <a href="{{ route('buy.equipments') }}" class="text-white text-lg font-semibold hover:underline">Buy Gym Equipments</a>
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="text-white text-lg font-semibold hover:underline">Logout</button>
    </form>
  </div>
  <div class="opacity-90 z-10 justify-center items-center pt-16">
    @yield('content')
  </div>
</div>
</body>
</html>