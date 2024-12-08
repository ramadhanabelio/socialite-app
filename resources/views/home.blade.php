<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Socialite App</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome, {{ auth()->user()->name }}</h1>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ auth()->user()->avatar }}" alt="Profile Image" class="rounded-circle" width="80"
                        height="80">
                    <div class="ms-3">
                        <h5 class="card-title">{{ auth()->user()->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p class="card-text"><strong>Username:</strong> {{ auth()->user()->name }}</p>
                        <p class="card-text"><strong>Login Type:</strong> {{ auth()->user()->login_type }}</p>
                    </div>
                </div>

                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>

    {{-- Bootstrap JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
