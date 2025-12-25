<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cloud Docs' }}</title>

    <!-- Alpine Plugins 
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    -->

    <!--alpine.js
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    -->

    @vite('resources/css/navbar.css')
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    {{ $slot }}
    @livewireScripts()
    @fluxScripts

    @livewire('wire-elements-modal')
</body>

</html>