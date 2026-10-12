<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSU Student Events | La Salle University - Ozamiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-full flex flex-col bg-gray-50/70 text-gray-800 antialiased selection:bg-green-700 selection:text-white">
    <div id="app" class="flex flex-col min-h-screen">
        @livewire('layout.public.navigation')

        <main class="flex-1">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        @livewire('layout.public.footer')
    </div>
</body>

</html>