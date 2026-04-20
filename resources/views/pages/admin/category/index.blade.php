@include('layouts.admin.head')
<title>Categories</title>

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
        <h1>Categories</h1>
        <p id="dateLabel"></p>
      </div>

      <a href="#" class="btn btn-sm text-white px-3 py-2"
         style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
        <i class="bi bi-plus-lg me-1"></i> Add Category
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
                <th>Name</th>
                <th>Total Products</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($categories as $category)
              <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $category->name }}</td>

                <td>{{ $category->products->count() }}</td>

                <td>
                  <a href="#" class="btn btn-sm btn-primary">Edit</a>

                  <form action="#" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center">No categories found</td>
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