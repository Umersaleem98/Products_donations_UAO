@include('layouts.admin.head')

<title>Update Users</title>

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                <!-- PAGE HEADER -->
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-account-edit"></i>
                        </span>
                        Edit User
                    </h3>
                </div>

                <!-- FORM CARD -->
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <form method="POST"
                                      action="{{ route('admin.user.update', $user->id) }}"
                                      enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')

                                    {{-- ================= ROW 1 ================= --}}
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text"
                                                   name="name"
                                                   value="{{ old('name', $user->name) }}"
                                                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                   placeholder="Enter full name"
                                                   required>

                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email"
                                                   name="email"
                                                   value="{{ old('email', $user->email) }}"
                                                   class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                   placeholder="Enter email"
                                                   required>

                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ================= ROW 2 ================= --}}
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                   placeholder="Leave blank to keep current password">

                                            <small class="text-muted">
                                                Only fill this if you want to change the password
                                            </small>

                                            @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Role</label>
                                            <select name="role"
                                                    class="form-control form-control-sm @error('role') is-invalid @enderror"
                                                    required>
                                                <option value="">Select Role</option>
                                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="beneficiary" {{ old('role', $user->role) == 'beneficiary' ? 'selected' : '' }}>Beneficiary</option>
                                                <option value="donor" {{ old('role', $user->role) == 'donor' ? 'selected' : '' }}>Donor</option>
                                            </select>

                                            @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ================= ROW 3 ================= --}}
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Qalam ID</label>
                                            <input type="text"
                                                   name="qalam_id"
                                                   value="{{ old('qalam_id', $user->qalam_id) }}"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter Qalam ID (optional)">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Profile Photo</label>
                                            <input type="file"
                                                   name="image"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>

                                    {{-- ================= CURRENT IMAGE ================= --}}
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Current Profile Photo</label><br>

                                            @if (!empty($user->image))
                                                <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                     width="90"
                                                     height="90"
                                                     style="object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                                            @else
                                                <span class="text-muted">No image available</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- ================= ACTION BUTTONS ================= --}}
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Update User
                                        </button>

                                        <a href="{{ route('admin.user.index') }}"
                                           class="btn btn-secondary btn-sm">
                                            Back
                                        </a>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@include('layouts.admin.script')
</body>
