@include('layouts.admin.head')

<title>Create Users</title>

<body>

<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">

            <div class="content-wrapper">

                <!-- HEADER -->
                <div class="page-header">

                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-account-plus"></i>
                        </span>
                        Create User
                    </h3>

                </div>

                <!-- FORM -->
                <div class="row">

                    <div class="col-md-10">

                        <div class="card shadow-sm">

                            <div class="card-body">

                                <form method="POST"
                                      action="{{ route('admin.user.store') }}"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <!-- ROW 1 -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Name
                                            </label>

                                            <input type="text"
                                                   name="name"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter full name..."
                                                   required>

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Email
                                            </label>

                                            <input type="email"
                                                   name="email"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter email address..."
                                                   required>

                                        </div>

                                    </div>

                                    <!-- ROW 2 -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Password
                                            </label>

                                            <input type="password"
                                                   name="password"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter password..."
                                                   required>

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Role
                                            </label>

                                            <select name="role"
                                                    id="role"
                                                    class="form-control form-control-sm"
                                                    required>

                                                <option value="">
                                                    Select Role
                                                </option>

                                                <option value="admin">
                                                    Admin
                                                </option>

                                                <option value="beneficiary">
                                                    Beneficiary
                                                </option>

                                                <option value="donor">
                                                    Donor
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- ROW 3 -->
                                    <div class="row">

                                        <div class="col-md-6 mb-3"
                                             id="qalamIdWrapper"
                                             style="display:none;">

                                            <label class="form-label">
                                                Qalam ID
                                            </label>

                                            <input type="text"
                                                   name="qalam_id"
                                                   id="qalam_id"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter Qalam ID">

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Profile Photo
                                            </label>

                                            <input type="file"
                                                   name="image"
                                                   class="form-control form-control-sm">

                                        </div>

                                    </div>

                                    <!-- BUTTONS -->
                                    <div class="mt-3">

                                        <button type="submit"
                                                class="btn btn-primary btn-sm">

                                            Save User

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

<script>

document.addEventListener('DOMContentLoaded', function () {

    const roleSelect = document.getElementById('role');
    const qalamWrapper = document.getElementById('qalamIdWrapper');
    const qalamInput = document.getElementById('qalam_id');

    function toggleQalamField() {

        if (roleSelect.value === 'beneficiary') {

            qalamWrapper.style.display = 'block';
            qalamInput.setAttribute('required', 'required');

        } else {

            qalamWrapper.style.display = 'none';
            qalamInput.removeAttribute('required');
            qalamInput.value = '';

        }

    }

    roleSelect.addEventListener('change', toggleQalamField);

    toggleQalamField();

});

</script>

</body>
