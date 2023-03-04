<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-slate-900">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}">

	<title inertia>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

	<!-- Scripts -->
	@routes
	@vite(['resources/js/app.js', "resources/sass/app.scss", "resources/js/Pages/{$page['component']}.vue"])
	@inertiaHead
</head>

<body class="font-sans antialiased bg-white dark:bg-slate-900">
	@inertia
</body>

</html>
