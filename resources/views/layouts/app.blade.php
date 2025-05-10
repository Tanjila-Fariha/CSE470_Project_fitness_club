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
  <!-- Your content here -->
  <div class="absolute top-5 right-5 flex flex-row space-x-10 z-50">
    <a href="{{ route('Membership.index') }}" class="text-white text-lg font-semibold hover:underline">Get Membership</a>
    <a href="success" class="text-white text-lg font-semibold hover:underline">Success Stories</a>

    <a href="#" class="text-white text-lg font-semibold hover:underline">About</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">Services</a>


    <!-- <a href="#" class="text-white text-lg font-semibold hover:underline">Buy Gym Equipments</a> -->
    <a href="{{ route('buy.equipments') }}" class="text-white text-lg font-semibold hover:underline">Buy Gym Equipments</a>


    <a href="{{ route('Logout.index') }}" class="text-white text-lg font-semibold hover:underline">Logout</a>


  </div>
  <div class="opacity-90 z-10 justify-center items-center pt-16">
    @yield('content')
  </div>

</div>
</body>
</html>