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
          <div class="col-md-8">

            <div class="card">
              <div class="card-body">

                <form method="POST"
                      action="{{ route('donor.product.store') }}"
                      enctype="multipart/form-data">
                  @csrf

                  <!-- ROW 1 -->
                  <div class="row">

                    <!-- NAME -->
                    <div class="col-md-6 mb-3">
                      <label>Product Name</label>
                      <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-md-6 mb-3">
                      <label>Category</label>
                      <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    </div>

                  </div>

                  <!-- ROW 2 -->
                  <div class="row">

                    <!-- PRICE -->
                    <div class="col-md-6 mb-3">
                      <label>Price</label>
                      <input type="number" name="price" class="form-control">
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-6 mb-3">
                      <label>Status</label>
                      <select name="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div>

                  </div>

                  <!-- DESCRIPTION -->
                  <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                  </div>

                  <!-- IMAGES -->
                  <div class="mb-3">
                    <label>Product Images</label>
                    <input type="file"
                           name="images[]"
                           class="form-control"
                           multiple>
                  </div>

                  <!-- BUTTONS -->
                  <button type="submit" class="btn btn-primary">
                    Save Product
                  </button>

                  <a href="{{ route('donor.product.index') }}"
                     class="btn btn-secondary">
                    Back
                  </a>

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
