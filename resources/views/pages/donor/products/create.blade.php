@include('layouts.admin.head')

<title>Create Products</title>

<style>
    .product-description {
        white-space: pre-line;
        line-height: 1.8;
    }
</style>

<body>

<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">

            <div class="content-wrapper">

                <!-- PAGE HEADER -->
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span>
                        Add Donor Product
                    </h3>
                </div>

                <!-- GLOBAL ERRORS -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <div class="row">

                    <div class="col-md-8">

                        <div class="card">

                            <div class="card-body">

                                <form method="POST"
                                      action="{{ route('donor.product.store') }}"
                                      enctype="multipart/form-data"
                                      id="productForm">

                                    @csrf

                                    <!-- PRODUCT NAME -->
                                    <div class="mb-3">
                                        <label>Product Name</label>

                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="form-control form-control-sm"
                                               placeholder="Enter product name..."
                                               required>

                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- CATEGORY -->
                                    <div class="mb-3">
                                        <label>Category</label>

                                        <select name="category_id"
                                                class="form-control form-control-sm"
                                                required>

                                            <option value="">Select Category</option>

                                            @foreach($categories as $cat)

                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>

                                                    {{ $cat->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- STATUS -->
                                    <div class="mb-3">
                                        <label>Status</label>

                                        <select name="status"
                                                class="form-control form-control-sm"
                                                required>

                                            <option value="">Select status</option>

                                            <option value="active"
                                                {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="inactive"
                                                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>

                                        </select>

                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- DESCRIPTION -->
                                    <div class="mb-3">
                                        <label>Description</label>

                                        <textarea name="description"
                                                  class="form-control form-control-sm"
                                                  rows="6"
                                                  placeholder="Enter product description...">{{ old('description') }}</textarea>

                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- IMAGES -->
                                    <div class="mb-3">
                                        <label>Product Images (Max 100KB each)</label>

                                        <input type="file"
                                               name="images[]"
                                               class="form-control form-control-sm"
                                               multiple
                                               id="imageInput"
                                               accept="image/*">

                                        <small class="text-muted">
                                            Only JPG, PNG, WEBP allowed. Max size: 100KB each.
                                        </small>

                                        @error('images.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- BUTTONS -->
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Save Product
                                    </button>

                                    <a href="{{ route('donor.product.index') }}"
                                       class="btn btn-secondary btn-sm">
                                        Back
                                    </a>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById('imageInput');

    input.addEventListener('change', function () {

        const files = this.files;

        for (let i = 0; i < files.length; i++) {

            const sizeKB = files[i].size / 1024;

            if (sizeKB > 1000) { // ✅ 1000 KB = 1MB

                alert(files[i].name + " is larger than 1MB. Please upload a smaller image.");

                this.value = ""; // reset input

                return;
            }
        }
    });

});
</script>
@include('layouts.admin.script')