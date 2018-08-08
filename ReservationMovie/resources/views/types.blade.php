<html>

<head>
    <meta charset="utf-8">
    <title>Type</title>
</head>

<body>
    
    @foreach ($types as $type)
        <h3>movie_id: {{ $type->movie_id }}</h3>
        movie_type: {{ $type->movie_type }}<br>
        movie_name: {{ $type->movie->movie_name }}<hr>
    @endforeach

</body>

</html>