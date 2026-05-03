@include('layouts.admin.head')

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- FORM -->
        <div class="row">
          <div class="col-md-10">

            <div class="card">
              <div class="card-body">

              @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form method="POST" action="{{ route('donor.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- ================= USER INFO ================= -->
            <h5>User Information</h5>

            <div class="row">

              <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
              </div>

              <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
              </div>

            </div>

            <!-- ================= IMAGE ================= -->
            <div class="row">

              <div class="col-md-6 mb-3">
                <label>Profile Image</label>
                <input type="file" name="image" class="form-control">
              </div>

              <div class="col-md-6 mb-3">
                <label>Preview</label><br>

                @if($user->image)
                <img src="{{ asset('admin/profileimg/' . $user->image) }}" width="100" height="100">
                @else
                <span>No Image</span>
                @endif

              </div>

            </div>

            <!-- ================= DONOR PROFILE ================= -->
            <h5 class="mt-4">Donor Profile</h5>

            <div class="row">

              <div class="col-md-6 mb-3">
                <label>Organization</label>
                <input type="text" name="organization" class="form-control"
                  value="{{ old('organization', optional($user->donorProfile)->organization) }}">
              </div>

              <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                  value="{{ old('phone', optional($user->donorProfile)->phone) }}">
              </div>

            </div>

            <!-- ================= PASSWORD ================= -->
            <h5 class="mt-4">Change Password</h5>

            <div class="row">

              <div class="col-md-6 mb-3">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control">
              </div>

              <div class="col-md-6 mb-3">
                <label>New Password</label>
                <input type="password" name="password" class="form-control">
              </div>

              <div class="col-md-6 mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
              </div>

            </div>

            <!-- ================= BUTTON ================= -->
            <button class="btn btn-primary">
              Update Profile
            </button>

          </form>

              </div>
            </div>

          </div>
        </div>



                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.admin.script')
