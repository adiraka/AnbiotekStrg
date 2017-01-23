<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Anbiotek Storage</title>

    <link href="favicon.ico" rel="shortcut icon" />

    @include('template.partials.assetcss')

    @stack('styles')

</head>

<body class="theme-indigo">

    @include('template.partials.pageloader')

    <div class="overlay"></div>

    @include('template.partials.searchbar')

    @include('template.partials.topbar')

    @include('template.partials.leftsidebar')

    @yield('content')

    @include('template.partials.assetjs')

    @stack('scripts')

</body>

</html>
