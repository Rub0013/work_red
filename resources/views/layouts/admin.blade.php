<html lang="en" class=" js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios no-ios7 ipad">
<head>
    <title>React Admin v1.0.0</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('partials.head')
</head>
<body>
<section class="vbox" id="wrapperContainer">
    <section data-reactroot="" class="vbox">
        <section>
            <section class="hbox stretch">
                @include('partials.navbar')
                @yield('content')
            </section>
        </section>
    </section>
</section>

</body>
</html>