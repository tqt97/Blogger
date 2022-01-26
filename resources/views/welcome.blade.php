<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/all.css" />
    <script>
        (function() {
            window.Laravel = {
                csrfToken: '{{ csrf_token() }}'
            }
        })()
    </script>
</head>

<body>
    <div id="app">

        {{-- @forelse ($tags as $tag)
        <li>{{ $tag->id }}- {{ $tag->tagName }}</li>
        @empty
        <p>No users</p>
        @endforelse --}}
        <base-template></base-template>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
