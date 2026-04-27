@include('layouts.admin.head')
<title>Donor Products</title>

<body class="h-100">

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <!-- Navbar -->
      <div class="main-navbar sticky-top bg-white">
        @include('layouts.admin.header')
      </div>

      <!-- Content -->
      <div class="main-content-container container-fluid px-4">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">My Products</h3>
          </div>
        </div>

        <!-- Products Table -->
        <div class="row">
          <div class="col-12">

            <div class="card shadow-sm">

              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Products List</h5>

                <a href="{{ route('donor.products.create') }}" class="btn btn-primary btn-sm">
                  + Add Product
                </a>
              </div>

              <div class="card-body">

                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Added By</th>
                      <th>Price</th>
                      <th width="180">Action</th>
                    </tr>
                  </thead>

                  <tbody>

                    @forelse($products as $key => $product)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->user->name ?? 'N/A' }}</td>
                        <td>{{ $product->price }}</td>

                        <td>
                          <!-- Edit -->
                          <a href="{{ route('donor.products.edit', $product->id) }}"
                             class="btn btn-warning btn-sm">
                             Edit
                          </a>

                          <!-- Delete -->
                          <form action="{{ route('donor.products.delete', $product->id) }}"
                                method="POST"
                                style="display:inline-block">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                              Delete
                            </button>

                          </form>
                        </td>
                      </tr>

                    @empty
                      <tr>
                        <td colspan="6" class="text-center">
                          No products found
                        </td>
                      </tr>
                    @endforelse

                  </tbody>

                </table>

              </div>

            </div>

          </div>
        </div>

      </div>

    </main>
  </div>
</div>

@include('layouts.admin.script')