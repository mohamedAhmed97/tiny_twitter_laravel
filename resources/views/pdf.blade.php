<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <h1>Report :</h1>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Tweets</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->Tweets()->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
