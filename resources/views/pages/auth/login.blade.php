@include('layouts.admin.head')
<title>Login</title>
<body>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">

        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
                    <div><span class="brand-name">NUST Gift Store</span><span class="brand-sub">Donate · Connect · Empower</span></div>
              {{-- <img src="{{ asset('admin/assets/images/logo.svg') }}"> --}}
            </div>

            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>

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

              <!-- Qalam ID (only for beneficiary) -->
              <div class="form-group" id="qalam_id_field" style="display:none;">
                <input type="text" name="qalam_id" class="form-control form-control-lg" placeholder="Qalam ID">
              </div>

              <!-- Email -->
              <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
              </div>

              <!-- Password -->
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
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
                <a href="#" class="auth-link text-primary">Forgot password?</a>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('layouts.admin.script')

<!-- Toggle Script -->
<script>
  document.getElementById('role').addEventListener('change', function () {
    let qalamField = document.getElementById('qalam_id_field');

    if (this.value === 'beneficiary') {
      qalamField.style.display = 'block';
    } else {
      qalamField.style.display = 'none';
    }
  });
</script>

