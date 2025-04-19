<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body>
        <header>
            <div>
            <img src="/images/logo.png" class="absolute inset-0 object-fill w-full h-full" alt="background image" />
            <div class="absolute top-5 right-5 flex flex-row space-x-10 z-50">
            @if (Route::has('login'))
                <nav class="absolute top-5 right-5 flex flex-row space-x-10 z-50 gap-6 bg-cover">
                        <a
                            href="{{ route('login') }}"
                            class="text-white text-lg font-bold hover:underline whitespace-nowrap"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="text-white text-lg font-bold hover:underline">
                                Register
                            </a>
                        @endif
                </nav>
            @endif
</div>
</div>
    </header>
    </body>
</html>