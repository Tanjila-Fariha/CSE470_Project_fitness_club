<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div>
  <img src="/images/logo.png" class="absolute inset-0 object-fill w-full h-full" alt="background image" />
  <!-- Your content here -->
  <div class="absolute top-5 right-5 flex flex-row space-x-10 z-50">
    <a href="#" class="text-white text-lg font-semibold hover:underline">Get</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">About</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">Services</a>
    <a href="#" class="text-white text-lg font-semibold hover:underline">Contact</a>
  </div>
  <div class="absolute inset-0 opacity-80 relative z-10 flex justify-center items-center pt-20">
    @yield('content')
  </div>

</div>
</body>
</html>