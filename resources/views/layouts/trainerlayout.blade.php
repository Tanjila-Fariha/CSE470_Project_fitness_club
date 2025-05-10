<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="relative min-h-screen">
  <img src="/images/logo.png" class="absolute object-fill w-full h-full" alt="background image" />
  <!-- Navigation Menu -->
  <div class="absolute top-5 right-5 space-x-10 z-50">
    <a href="{{ route('trainer_home') }}" class="text-white text-lg font-semibold hover:underline">Dashboard</a>
    <a href="{{ route('trainers.classes.index') }}" class="text-white text-lg font-semibold hover:underline">My Classes</a>
    <a href="{{ route('trainers.classes.create') }}" class="text-white text-lg font-semibold hover:underline">Create Class</a>
    <a href="{{ route('AddGymEquipments.index') }}" class="text-white text-lg font-semibold hover:underline">Add Gym Equipments</a>
    <a href="{{ route('sold.orders') }}" class="text-white text-lg font-semibold hover:underline">View Orders</a>

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