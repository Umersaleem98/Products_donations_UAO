@include('layouts.admin.head')
<title>Login</title>

<body class="bg-dark">
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Login Section -->
        <div class="container-fluid">
            <div class="row vh-100 justify-content-center align-items-center">

                <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background: #1f2937;">

                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <h2 class="text-primary fw-bold">
                                <i class="fa fa-user-edit me-2"></i>DarkPan
                            </h2>
                            <p class="text-light mb-0">Welcome back! Please login</p>
                        </div>

                        <!-- Global Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- Form Start -->
                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label text-light">Email Address</label>
                                <input type="email"
                                    name="email"
                                    class="form-control form-control-lg bg-dark text-light border-secondary @error('email') is-invalid @enderror"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}"
                                    required>

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label text-light">Password</label>
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-lg bg-dark text-light border-secondary @error('password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required>

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                    <label class="form-check-label text-light" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-primary small">Forgot Password?</a>
                            </div>

                            <!-- Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Login
                                </button>
                            </div>
                        </form>
                        <!-- Form End -->

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-light mb-0">
                                Don't have an account?
                                <a href="{{ route('register.index') }}" class="text-primary">Register</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Login Section -->
    </div>

@include('layouts.admin.script')