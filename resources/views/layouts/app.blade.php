<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ __('messages.app_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
    @livewireStyles
</head>
<body class="bg-zinc-950 min-h-screen">
    {{ $slot }}
    @livewireScripts
</body>
</html>
