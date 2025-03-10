<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Open Graph meta tags (for Facebook, Messenger, etc.) -->
    <meta property="og:title" content="TripidKard">
    <meta property="og:description" content="Discover more with TripidKard">
    <meta property="og:image" content="{{ asset('/storage/img/logo.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter meta tags (for Twitter link previews) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TripidKard">
    <meta name="twitter:description" content="Discover more with TripidKard">
    <meta name="twitter:image" content="{{ asset('/storage/img/logo.jpg') }}">
    <title>TripidKard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Onest&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="{{ asset('/storage/img/logo.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div id="app">
        <router-view></router-view>
    </div>

</body>

</html>
