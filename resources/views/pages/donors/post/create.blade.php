@include('layouts.admin.head')
<title>Add Donation</title>

<body>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
  <div class="content-area">

    <!-- HEADER -->
    <div class="page-header mb-3">
        <h1>Add Donation</h1>
    </div>

    @include('layouts.admin.components.alert')

    <!-- FORM CARD -->
    <div class="card shadow-sm" style="border-radius:12px;">
      <div class="card-body">

        <form action="{{ route('donor.post.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- ROW 1 -->
          <div class="row">

            <!-- Title -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter title">
              @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Category -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Category</label>
              <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
              @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

          </div>

          <!-- ROW 2 -->
          <div class="row">

            <!-- Type -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Type</label>
              <select name="type" class="form-control">
                <option value="donate">Donate</option>
                <option value="sale">Sale</option>
              </select>
              @error('type') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Price</label>
              <input type="number" name="price" class="form-control" placeholder="Enter price">
            </div>

          </div>

          <!-- ROW 3 -->
          <div class="row">

            <!-- Condition -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Condition</label>
              <select name="condition" class="form-control">
                <option value="new">New</option>
                <option value="used">Used</option>
              </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <select name="is_active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>

          </div>

          <!-- ROW 4 (FULL WIDTH) -->
          <div class="row">

            <!-- Description -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" rows="4" class="form-control" placeholder="Enter description"></textarea>
            </div>

          </div>

          <!-- ROW 5 -->
          <div class="row">

            <!-- Images -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Images</label>
              <input type="file" name="images[]" multiple class="form-control">
            </div>

          </div>

          <!-- SUBMIT -->
          <div class="text-end">
            <button class="btn btn-primary px-4">
              Save Donation
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</main>

@include('layouts.admin.script')

</body>