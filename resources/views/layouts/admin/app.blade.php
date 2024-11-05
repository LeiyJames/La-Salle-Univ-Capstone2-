<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSU Student Events</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full">
    <div id="app" x-data="main">
        @livewire('layout.admin.sidebar')

        <div x-bind:class="sidebar ? 'pl-64' : 'pl-[72px]'">
            @livewire('layout.admin.header')

            <main class="py-5">
                <div class="px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('main', () => ({
                    sidebar: true,
         
                    toggleSidebar() {
                        this.sidebar = ! this.sidebar
                    },
                }))
            })
        </script>
    </div>
</body>

</html>