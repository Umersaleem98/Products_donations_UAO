@include('layouts.admin.head')
<title>Donations</title>

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
        <h1>Donations</h1>
        <p id="dateLabel"></p>
      </div>

      @include('layouts.admin.components.alert')

      <a href="{{ route('donor.post.index') }}" 
         class="btn btn-sm text-white px-3 py-2"
         style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
        <i class="bi bi-plus-lg me-1"></i> Add post
      </a>
    </div>

    <!-- TABLE -->
    <div class="card mt-3" style="border-radius:12px;">
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-hover align-middle">

            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Donor</th>
                <th>Category</th>
                <th>Type</th>
                <th>Price</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($products as $product)
              <tr>

                <td>{{ $loop->iteration }}</td>

                <!-- Image -->
                <td>
                  @if($product->images->first())
                    <img src="{{ asset('storage/'.$product->images->first()->image_path) }}" 
                         width="50" height="50" style="object-fit:cover; border-radius:6px;">
                  @else
                    <span class="text-muted">No Image</span>
                  @endif
                </td>

                <!-- Title -->
                <td>{{ $product->title }}</td>

                <!-- Donor -->
                <td>{{ $product->user->name ?? '-' }}</td>

                <!-- Category -->
                <td>{{ $product->category->name ?? '-' }}</td>

                <!-- Type -->
                <td>
                  <span class="badge bg-info text-dark">
                    {{ ucfirst($product->type) }}
                  </span>
                </td>

                <!-- Price -->
                <td>
                  @if($product->price)
                    Rs {{ number_format($product->price) }}
                  @else
                    Free
                  @endif
                </td>

                <!-- Condition -->
                <td>{{ ucfirst($product->condition) }}</td>

                <!-- Status -->
                <td>
                  @if($product->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>

                <!-- Date -->
                <td>{{ $product->created_at->format('d M Y') }}</td>

                <!-- Actions -->
                <td>

                  <!-- Edit -->
                  <a href="{{ route('donor.post.edit', $product->id) }}" 
                     class="btn btn-sm btn-warning">
                    Edit
                  </a>

                  <!-- Delete -->
                  <form action="{{ route('donor.post.destroy', $product->id) }}" 
                        method="POST" 
                        style="display:inline-block;"
                        onsubmit="return confirm('Delete this donation?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger">
                      Delete
                    </button>
                  </form>

                </td>

              </tr>

              @empty
              <tr>
                <td colspan="11" class="text-center">No donations found</td>
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