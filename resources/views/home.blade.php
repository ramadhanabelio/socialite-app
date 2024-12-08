<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Menggunakan Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome, {{ auth()->user()->name }}</h1>

        <div class="card">
            <div class="card-body">
                <!-- Menampilkan gambar profil jika ada -->
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ auth()->user()->avatar }}" alt="Profile Image" class="rounded-circle" width="80"
                        height="80">
                    <div class="ms-3">
                        <h5 class="card-title">{{ auth()->user()->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p class="card-text"><strong>Username:</strong> {{ auth()->user()->name }}</p>
                    </div>
                </div>

                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>

    <!-- Menambahkan script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
