<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 offset-md-4">
        <div class="card p-4">
            <h4 class="text-center">Login</h4>

            <form method="POST" action="/login">
                @csrf

                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

                <button class="btn btn-primary w-100">Login</button>
            </form>

            <a href="/register" class="text-center mt-2 d-block">Register</a>
        </div>
    </div>
</div>

</body>
</html>