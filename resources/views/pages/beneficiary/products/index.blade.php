@include('layouts.admin.head')

@php use Illuminate\Support\Str; @endphp

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
  <div class="content-area">

    <!-- HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
      <div>
        <h1>Products</h1>
        <p id="dateLabel"></p>
      </div>
    </div>

    <!-- CATEGORY FILTER -->
    <form method="GET" class="mb-4">
      <div class="row">

        <div class="col-md-4">
          <select name="category_id" onchange="this.form.submit()" class="form-select">
            <option value="">All Categories</option>

            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach

          </select>
        </div>

      </div>
    </form>

    <!-- PRODUCTS GRID -->
    <div class="row">

      @forelse($products as $product)
      <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 shadow-sm product-card">

          <!-- IMAGE -->
          @if($product->image)
            <img src="{{ asset('admins/assets/img/dummy.png') }}"
                 class="card-img-top"
                 style="height:180px; object-fit:cover;">
          @else
            <img src=""
                 class="card-img-top"
                 style="height:180px; object-fit:cover;">
          @endif

          <!-- BODY -->
          <div class="card-body d-flex flex-column">

            <h5 class="card-title mb-1">
              {{ $product->title }}
            </h5>

            <small class="text-muted mb-2">
              {{ $product->category->name ?? 'No Category' }}
            </small>

            <p class="card-text">
              {{ Str::limit($product->description, 80) }}
            </p>

            <div class="mt-auto">

              <p class="mb-1 small">
                <strong>By:</strong> {{ $product->user->name ?? 'N/A' }}
              </p>

              <p class="mb-2 small">
                <strong>Price:</strong> {{ $product->price ?? 'N/A' }}
              </p>

              <a href="{{ route('beneficiary.products.show', $product->id) }}"
                 class="btn btn-sm w-100 text-white"
                 style="background:var(--primary); border-radius:8px;">
                View Details
              </a>

            </div>

          </div>

        </div>

      </div>
      @empty
        <div class="col-12 text-center">
          <p>No products found.</p>
        </div>
      @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-4">
      {{ $products->withQueryString()->links() }}
    </div>

  </div>
</main>

@include('layouts.admin.script')

<style>
.product-card {
  border-radius: 12px;
  overflow: hidden;
  transition: 0.3s ease;
}

.product-card:hover {
  transform: translateY(-6px);
}

.card-text {
  font-size: 0.9rem;
}

.small {
  font-size: 0.85rem;
}
</style>

<script>
document.getElementById('dateLabel').innerText =
  new Date().toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
</script>

</body>