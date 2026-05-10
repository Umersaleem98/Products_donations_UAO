@include('layouts.admin.head')

<title>Create Categories</title>

<style>

    .card{
        border:none;
        border-radius:15px;
        box-shadow:0 0 20px rgba(0,0,0,0.05);
    }

    .form-control{
        border-radius:10px;
        height:45px;
    }

    label{
        font-weight:600;
        margin-bottom:8px;
    }

    .btn{
        border-radius:8px;
    }

</style>

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
                            <i class="mdi mdi-folder-plus"></i>
                        </span>
                        Create Category
                    </h3>

                </div>

                <!-- ALERTS -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
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

                <!-- FORM -->
                <div class="row">

                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-body">

                                <form action="{{ route('admin.category.store') }}" method="POST">

                                    @csrf

                                    <!-- CATEGORY NAME -->
                                    <div class="form-group mb-3">

                                        <label>Category Name</label>

                                        <input type="text"
                                               name="name"
                                               class="form-control"
                                               placeholder="Enter category name"
                                               value="{{ old('name') }}"
                                               required>

                                    </div>

                                    <!-- BUTTONS -->
                                    <div class="d-flex gap-2">

                                        <button type="submit" class="btn btn-primary">
                                            Save Category
                                        </button>

                                        <a href="{{ route('admin.category.index') }}"
                                           class="btn btn-secondary">
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