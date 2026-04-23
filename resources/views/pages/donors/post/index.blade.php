@include('layouts.admin.head')
<title>Donations</title>

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
  <div class="content-area">

    <!-- HEADER -->
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1>Donations</h1>
        <p id="dateLabel"></p>
      </div>

      @include('layouts.admin.components.alert')

      <a href="{{ route('donor.post.create') }}"
         class="btn btn-sm text-white px-3 py-2"
         style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
        <i class="bi bi-plus-lg me-1"></i> Add Post
      </a>
    </div>

    <!-- TABLE CARD -->
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
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @forelse($products as $product)
              <tr>

                <!-- INDEX -->
                <td>{{ $loop->iteration }}</td>

                <!-- IMAGE -->
                <td>
                  @if($product->images && $product->images->first())
                    <img src="{{ asset('storage/'.$product->images->first()->image_path) }}"
                         width="50" height="50"
                         style="object-fit:cover;border-radius:6px;">
                  @else
                    <img src="{{ asset('admins/assets/img/dummy.png') }}"
                         width="50" height="50"
                         style="object-fit:cover;border-radius:6px;">
                  @endif
                </td>

                <!-- TITLE -->
                <td>{{ $product->title }}</td>

                <!-- DONOR -->
                <td>{{ $product->user->name ?? '-' }}</td>

                <!-- CATEGORY -->
                <td>{{ $product->category->name ?? '-' }}</td>

                <!-- TYPE -->
                <td>
                  <span class="badge bg-info text-dark">
                    {{ ucfirst($product->type) }}
                  </span>
                </td>

                <!-- PRICE -->
                <td>
                  @if($product->price)
                    Rs {{ number_format($product->price) }}
                  @else
                    Free
                  @endif
                </td>

                <!-- CONDITION -->
                <td>{{ ucfirst($product->condition) }}</td>

                <!-- STATUS -->
                <td>
                  @if($product->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>

                <!-- DATE -->
                <td>{{ $product->created_at->format('d M Y') }}</td>

                <!-- ACTIONS -->
                <td class="d-flex gap-1">

                  <a href="{{ route('donor.post.edit', $product->id) }}"
                     class="btn btn-sm btn-warning">
                    Edit
                  </a>

                  <form action="{{ route('donor.post.destroy', $product->id) }}"
                        method="POST"
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
                <td colspan="11" class="text-center py-4">
                  No donations found
                </td>
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