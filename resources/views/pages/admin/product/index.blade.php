@include('layouts.admin.head')
<title>Products</title>

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<!-- ═══════════════════ MAIN ═══════════════════════ -->
<main id="main">
  <div class="content-area">

    <!-- Header -->
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1>Products</h1>
        <p id="dateLabel"></p>
      </div>

      <a href="#" class="btn btn-sm text-white px-3 py-2"
         style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
        <i class="bi bi-plus-lg me-1"></i> Add Product
      </a>
    </div>

    <!-- TABLE -->
    <div class="card mt-3" style="border-radius:12px;">
      <div class="card-body">

        <div class="table-responsive">
          <table class="table align-middle table-hover">

            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Type</th>
                <th>Price</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($products as $product)
              <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $product->title }}</td>

                <td>{{ $product->user->name ?? 'N/A' }}</td>

                <td>{{ $product->category->name ?? 'N/A' }}</td>

                <td>{{ ucfirst($product->type) }}</td>

                <td>Rs {{ number_format($product->price) }}</td>

                <td>
                  <span class="badge bg-secondary">
                    {{ ucfirst($product->condition) }}
                  </span>
                </td>

                <td>
                  @if($product->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>

                <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center">No products found</td>
              </tr>
              @endforelse
            </tbody>

          </table>
        </div>

      </div>
    </div>

  </div>
</main>

@include('layouts.admin.script')

</body>