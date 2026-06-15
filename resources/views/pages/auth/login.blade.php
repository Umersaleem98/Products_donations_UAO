@include('layouts.admin.head')

<title>Login</title>

<style>
body {
    background: linear-gradient(135deg, #306DB0, #4f46e5);
    min-height: 100vh;
}

.login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-card {
    width: 100%;
    max-width: 520px;
    background: rgba(255,255,255,0.96);
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

.logo {
    width: 120px;
    display: block;
    margin: 0 auto 15px;
}

.title {
    text-align: center;
    font-weight: 700;
}

.subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 25px;
}

.form-control {
    height: 50px;
    border-radius: 12px;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: none;
}

.btn-login {
    width: 100%;
    height: 50px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #306DB0, #4f46e5);
    color: #fff;
    font-weight: 600;
    transition: 0.3s;
}

.btn-login:hover {
    transform: translateY(-2px);
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.captcha-box {
    margin-top: 10px;
}

.captcha-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-top: 10px;
}

.captcha-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #ddd;
    cursor: pointer;
    transition: 0.2s;
}

.captcha-item:hover {
    border-color: #4f46e5;
    transform: scale(1.02);
}

.captcha-item img {
    width: 100%;
    height: 90px;
    object-fit: cover;
}

.captcha-item input {
    position: absolute;
    top: 10px;
    left: 10px;
    transform: scale(1.3);
}

@media(max-width:576px){
    .login-card{
        padding:25px;
    }
}
</style>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- Logo -->
        <img src="{{ asset('admins/assets/images/logos/logo.png') }}" class="logo">

        <h3 class="title">Welcome Back</h3>
        <p class="subtitle">Sign in to continue</p>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Role -->
            <div class="form-group mb-3">
                <select name="role" id="role" class="form-control" required>
                    <option value="">Select Role</option>
                    <option value="beneficiary" {{ old('role')=='beneficiary'?'selected':'' }}>Beneficiary</option>
                    <option value="donor" {{ old('role')=='donor'?'selected':'' }}>Donor</option>
                    <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                </select>
            </div>

            <!-- Qalam ID -->
            <div class="form-group mb-3"
                 id="qalam_id_field"
                 style="{{ old('role')=='beneficiary'?'':'display:none;' }}">

                <input type="text"
                       name="qalam_id"
                       class="form-control"
                       placeholder="Enter Qalam ID"
                       value="{{ old('qalam_id') }}">
            </div>

            <!-- Email -->
            <div class="form-group mb-3">
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Email Address"
                       value="{{ old('email') }}"
                       required>
            </div>

            <!-- Password -->
            <div class="form-group mb-3 position-relative">
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Password"
                       required>

                <span class="password-toggle" onclick="togglePassword()">👁️</span>
            </div>

            <!-- IMAGE CAPTCHA -->
            <div class="form-group mb-3 captcha-box">

                <label class="font-weight-bold">
                    {{ session('captcha_question') ?? 'Verify images' }}
                </label>

                <div class="captcha-grid">

                    @if(session('captcha_images'))
                        @foreach(session('captcha_images') as $index => $img)

                            <label class="captcha-item">
                                <input type="checkbox"
                                       name="captcha_selected[]"
                                       value="{{ $index }}">

                                <img src="{{ asset('captcha/'.$img['img']) }}">
                            </label>

                        @endforeach
                    @endif

                </div>

            </div>

            <!-- Remember -->
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label">Remember Me</label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">
                SIGN IN
            </button>

        </form>

    </div>

</div>

@include('layouts.admin.script')

<script>

document.getElementById('role').addEventListener('change', function () {
    let qalam = document.getElementById('qalam_id_field');
    qalam.style.display = (this.value === 'beneficiary') ? 'block' : 'none';
});

function togglePassword() {
    let p = document.getElementById('password');
    p.type = (p.type === 'password') ? 'text' : 'password';
}

</script>

</body>
