@include('layouts.admin.head')
<title>Login</title>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html">
                                <h3 class="text-primary">
                                    <i class="fa fa-user-edit me-2"></i>DarkPan
                                </h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>

                        <!-- 🔴 GLOBAL ERROR -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- ✅ FORM START -->
                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="floatingInput"
                                    placeholder="name@example.com"
                                    value="{{ old('email') }}"
                                    required>

                                <label for="floatingInput">Email address</label>

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="floatingPassword"
                                    placeholder="Password"
                                    required>

                                <label for="floatingPassword">Password</label>

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                        name="remember"
                                        class="form-check-input"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">
                                        Check me out
                                    </label>
                                </div>
                                <a href="#">Forgot Password</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">
                                Sign In
                            </button>
                        </form>
                        <!-- ✅ FORM END -->

                        <p class="text-center mb-0">
                            Don't have an Account?
                            <a href="{{ route('register.index') }}">Sign Up</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

@include('layouts.admin.script')