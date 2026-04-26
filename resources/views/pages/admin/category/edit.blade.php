@include('layouts.admin.head')

<body class="h-100">

<div class="container-fluid">
  <div class="row">

    @include('layouts.admin.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <div class="main-navbar sticky-top bg-white">
        @include('layouts.admin.header')
      </div>

      <div class="main-content-container container-fluid px-4">

        <div class="page-header row no-gutters py-4">
          <div class="col-12">
            <h3>Edit Category</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

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

      </div>

    </main>
  </div>
</div>

@include('layouts.admin.script')