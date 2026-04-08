@extends('template.main')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="row">
        <div class="col-8">
            <h1>User Details</h1>

            @forelse ($users as $user)
                <p><strong>Name:</strong> {{ $user['name'] }}</p>
                <p><strong>Email:</strong> {{ $user['email'] }}</p>
                <p><strong>Role:</strong> {{ $user['role'] }}</p>
                <hr>
            @empty
                <!-- untuk display content html daripada controller tanpa papar h1 dan seumpanya -->
                {!!$html!!}

            @endforelse

        </div>
        <div class="col-4 bg-primary text-white">
            @include('template.sidebar')
        </div>
    </div>
</body>
</html>

@endsection