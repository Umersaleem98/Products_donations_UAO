.@include('layouts.admin.head')
<title>Admin Product Edit</title>
<body class="h-100">

<div class="container-fluid">
  <div class="row">

    @include('layouts.admin.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <div class="main-navbar sticky-top bg-white">
        @include('layouts.admin.header')
      </div>

      <div class="main-content-container container-fluid px-4">

        <!-- Header -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12">
            <h3 class="page-title">Edit Product</h3>
          </div>
        </div>

        <!-- FORM -->
        <div class="row">
          <div class="col-md-6">

            <div class="card">
              <div class="card-body">

                <form method="POST" action="{{ route('admin.products.update',$product->id) }}">
                  @csrf
                  @method('PUT')

                  <!-- Name -->
                  <div class="form-group mb-3">
                    <label>Product Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           class="form-control"
                           required>
                  </div>

                  <!-- Category -->
                  <div class="form-group mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                      @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                          {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                          {{ $cat->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Price -->
                  <div class="form-group mb-3">
                    <label>Price</label>
                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
                           class="form-control"
                           required>
                  </div>

                  <!-- Description -->
                  <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">
{{ $product->description }}
                    </textarea>
                  </div>

                  <!-- Buttons -->
                  <button class="btn btn-success">Update Product</button>

                  <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
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