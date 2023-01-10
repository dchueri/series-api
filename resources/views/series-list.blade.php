<!DOCTYPE html>

<body>
    <h1>Series</h1>

    <ul>
        @foreach ($series as $serie)
        <li>{{$serie}}</li>
        @endforeach
    </ul>
</body>