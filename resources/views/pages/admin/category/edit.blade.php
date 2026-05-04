@include('layouts.admin.head')
<title>Update Categories</title>
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
                  
 <div class="card">
              <div class="card-body">

                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <!-- NAME -->
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $category->name }}"
                           class="form-control"
                           required>
                  </div>

                  <!-- BUTTON -->
                  <button type="submit" class="btn btn-success">
                    Update Category
                  </button>

                  <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    Back
                  </a>

                </form>

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
