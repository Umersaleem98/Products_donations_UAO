@include('layouts.admin.head')
<title>Login</title>

<body>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">

        <div class="col-lg-6 mx-auto">
          <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
              <div>
                <span class="brand-name">NUST Gift Store</span>
                <span class="brand-sub">Donate · Connect · Empower</span>
              </div>
            </div>

            <!-- Role Selection -->
            <form method="POST" action="{{ route('login') }}" class="pt-3">
              @csrf

              <div class="form-group">
                <select name="role" id="role" class="form-control form-control-lg" required>
                  <option value="">Select Role</option>
                  <option value="beneficiary">Beneficiary</option>
                  <option value="donor">Donor</option>
                  <option value="admin">Admin</option>
                </select>
              </div>

              <!-- Qalam ID -->
              <div class="form-group" id="qalam_id_field" style="display:none;">
                <input type="text" name="qalam_id" class="form-control form-control-lg" placeholder="Qalam ID">
              </div>

              <!-- Email -->
              <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
              </div>

              <!-- Password with Toggle -->
              <div class="form-group position-relative">
                <input type="password" id="password" name="password"
                       class="form-control form-control-lg"
                       placeholder="Password" required>

                <!-- Toggle Button -->
                <span onclick="togglePassword()" 
                      style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;">
                  👁️
                </span>
              </div>

              <!-- Submit -->
              <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium">
                  SIGN IN
                </button>
              </div>

              <!-- Extras -->
              <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" class="form-check-input"> Keep me signed in
                  </label>
                </div>
                <a href="#" class="auth-link text-info">Forgot password?</a>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('layouts.admin.script')

<!-- Scripts -->
<script>
  // Role Toggle
  document.getElementById('role').addEventListener('change', function () {
    let qalamField = document.getElementById('qalam_id_field');

    if (this.value === 'beneficiary') {
      qalamField.style.display = 'block';
    } else {
      qalamField.style.display = 'none';
    }
  });

  // Password Toggle
  function togglePassword() {
    let passwordInput = document.getElementById('password');

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
</script>

</body>