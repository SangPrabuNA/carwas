<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarWash - Premium Car Wash Service</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body>
    <div id="landing-page" data-page="{{ json_encode($page) }}"></div>
</body>
</html>