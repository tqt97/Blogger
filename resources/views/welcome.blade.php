<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog Laravel</title>
    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('./js/static/owl.carousel.min.css') }}"> --}}
    <link rel="stylesheet" href="./css/all.css" />
    <script>
        (function() {
            window.Laravel = {
                csrfToken: '{{ csrf_token() }}'
            }
        })()
    </script>
    {{-- <script src="{{ asset('./js/static/jquery.min.js') }}"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> --}}

    {{-- <script src="{{ asset('./js/static/custom.js') }}"></script> --}}
    <!-- JS Global Compulsory -->
    {{-- <script src="./js/static/bootstrap.bundle.min.js"></script> --}}

    <!-- JS Implementing Plugins-->
    {{-- <script src="{{ asset('./js/static/jquery.magnific-popup.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('./js/static/owl.carousel.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('./js/static/jquery.easing.min.js') }}"></script> --}}

    <!-- JS Ambassador -->
    {{-- <script src="{{ asset('./js/static/ambassador.js') }}"></script> --}}
</head>

<body>
    <div id="app">

        {{-- @forelse ($tags as $tag)
        <li>{{ $tag->id }}- {{ $tag->tagName }}</li>
        @empty
        <p>No users</p>
        @endforelse --}}
        @if (Auth::check())
            <base-template :user="{{ Auth::user() }}"></base-template>
        @else
            <base-template :user="false"></base-template>
        @endif
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
