@include('layouts.admin.head')
<title>Edit Donation</title>

<body>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
  <div class="content-area">

    <!-- HEADER -->
    <div class="page-header mb-3">
        <h1>Edit Donation</h1>
        <p id="dateLabel"></p>
    </div>

    @include('layouts.admin.components.alert')

    <!-- FORM CARD -->
    <div class="card shadow-sm" style="border-radius:12px;">
      <div class="card-body">

        <form action="{{ route('donor.post.update', $product->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">

            <!-- Title -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Title</label>
              <input type="text"
                     name="title"
                     value="{{ $product->title }}"
                     class="form-control">
            </div>

            <!-- Category -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Category</label>
              <select name="category_id" class="form-control">
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}"
                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              </select>
            </div>

          </div>

          <div class="row">

            <!-- Type -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Type</label>
              <select name="type" class="form-control">
                <option value="donate" {{ $product->type == 'donate' ? 'selected' : '' }}>Donate</option>
                <option value="sale" {{ $product->type == 'sale' ? 'selected' : '' }}>Sale</option>
              </select>
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Price</label>
              <input type="number"
                     name="price"
                     value="{{ $product->price }}"
                     class="form-control">
            </div>

          </div>

          <div class="row">

            <!-- Condition -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Condition</label>
              <select name="condition" class="form-control">
                <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>New</option>
                <option value="used" {{ $product->condition == 'used' ? 'selected' : '' }}>Used</option>
              </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <select name="is_active" class="form-control">
                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

          </div>

          <!-- DESCRIPTION -->
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
          </div>

          <!-- CURRENT IMAGE -->
          <div class="mb-3">
            <label class="form-label">Current Image</label><br>

            @if($product->image)
              <img src="{{ asset('storage/'.$product->image) }}"
                   width="120"
                   style="border-radius:8px;">
            @else
              <img src="{{ asset('admins/assets/img/dummy.png') }}"
                   width="120"
                   style="border-radius:8px;">
            @endif
          </div>

          <!-- NEW IMAGE -->
          <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control">
          </div>

          <!-- SUBMIT -->
          <div class="text-end">
            <button class="btn btn-success px-4">
              Update Donation
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</main>

@include('layouts.admin.script')

</body>