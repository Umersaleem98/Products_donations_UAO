@include('layouts.admin.head')
<title>Donor Product Add</title>

<body class="h-100">

<div class="container-fluid">
  <div class="row">

    @include('layouts.admin.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <div class="main-navbar sticky-top bg-white">
        @include('layouts.admin.header')
      </div>

      <div class="main-content-container container-fluid px-4">

        <!-- HEADER -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12">
            <h3 class="page-title">Create Product</h3>
          </div>
        </div>

        <!-- FORM -->
        <div class="row">
          <div class="col-md-8">

            <div class="card">
              <div class="card-body">

                <form method="POST"
                      action="{{ route('donor.products.store') }}"
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

                  <a href="{{ route('donor.products.index') }}"
                     class="btn btn-secondary">
                    Back
                  </a>

                </form>

              </div>
            </div>

          </div>
        </div>

      </div>

    </main>
  </div>
</div>

@include('layouts.admin.script')