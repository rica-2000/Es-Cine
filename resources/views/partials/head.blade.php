<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@php
	$manifestPath = public_path('build/manifest.json');
	$isProduction = app()->environment('production');
@endphp

@if ($isProduction && file_exists($manifestPath))
	@php
		$manifest = json_decode(file_get_contents($manifestPath), true) ?: [];
		$cssFile = $manifest['resources/css/app.css']['file'] ?? null;
		$jsFile = $manifest['resources/js/app.js']['file'] ?? null;
	@endphp

	@if ($cssFile)
		<link rel="stylesheet" href="/{{ ltrim('build/'.$cssFile, '/') }}">
	@endif

	@if ($jsFile)
		<script type="module" src="/{{ ltrim('build/'.$jsFile, '/') }}"></script>
	@endif
@else
	@vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

@fluxAppearance
