@include('layouts.admin.head')

<title>Update Product</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content Area --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Update Product
                    </h3>

                    <p class="text-secondary small mb-0">
                        Update product information, status and images.
                    </p>
                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-light border d-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Products</span>
                </a>

            </div>


            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">

                <ol class="breadcrumb small mb-0">

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-decoration-none"
                        >
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="text-decoration-none"
                        >
                            Products
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Update Product
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            <div class="row justify-content-center">

                <div class="col-12 col-xl-10">

                    <form
                        method="POST"
                        action="{{ route('admin.products.update', $product->id) }}"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')


                        <div class="row g-4">

                            {{-- Main Product Form --}}
                            <div class="col-12 col-lg-8">

                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                                    {{-- Card Header --}}
                                    <div class="card-header bg-white border-bottom px-4 py-3">

                                        <div class="d-flex align-items-center gap-3">

                                            <span
                                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                                style="width: 46px; height: 46px;"
                                            >
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </span>

                                            <div>
                                                <h5 class="fw-semibold text-dark mb-1">
                                                    Product Information
                                                </h5>

                                                <p class="text-secondary small mb-0">
                                                    Editing:
                                                    <span class="fw-semibold">
                                                        {{ $product->name }}
                                                    </span>
                                                </p>
                                            </div>

                                        </div>

                                    </div>


                                    {{-- Card Body --}}
                                    <div class="card-body p-4">

                                        <div class="row g-4">

                                            {{-- Product Name --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="productName"
                                                    class="form-label fw-semibold"
                                                >
                                                    Product Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-box-seam"></i>
                                                    </span>

                                                    <input
                                                        type="text"
                                                        id="productName"
                                                        name="name"
                                                        value="{{ old('name', $product->name) }}"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Enter product name"
                                                        required
                                                        autofocus
                                                    >

                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                            </div>


                                            {{-- Category --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="categoryId"
                                                    class="form-label fw-semibold"
                                                >
                                                    Category
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="category_id"
                                                    id="categoryId"
                                                    class="form-select @error('category_id') is-invalid @enderror"
                                                    required
                                                >
                                                    <option value="">
                                                        Select category
                                                    </option>

                                                    @foreach ($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}"
                                                            @selected(
                                                                old(
                                                                    'category_id',
                                                                    $product->category_id
                                                                ) == $category->id
                                                            )
                                                        >
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>


                                            {{-- Status --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="productStatus"
                                                    class="form-label fw-semibold"
                                                >
                                                    Product Status
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="status"
                                                    id="productStatus"
                                                    class="form-select @error('status') is-invalid @enderror"
                                                    required
                                                >
                                                    <option value="">
                                                        Select status
                                                    </option>

                                                    <option
                                                        value="active"
                                                        @selected(
                                                            old(
                                                                'status',
                                                                $product->status
                                                            ) === 'active'
                                                        )
                                                    >
                                                        Active
                                                    </option>

                                                    <option
                                                        value="inactive"
                                                        @selected(
                                                            old(
                                                                'status',
                                                                $product->status
                                                            ) === 'inactive'
                                                        )
                                                    >
                                                        Inactive
                                                    </option>
                                                </select>

                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div class="form-text">
                                                    Inactive products will not be shown to beneficiaries.
                                                </div>

                                            </div>


                                            {{-- Product ID --}}
                                            <div class="col-12 col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Product ID
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-hash"></i>
                                                    </span>

                                                    <input
                                                        type="text"
                                                        class="form-control bg-light"
                                                        value="{{ $product->id }}"
                                                        readonly
                                                    >

                                                </div>

                                            </div>


                                            {{-- Description --}}
                                            <div class="col-12">

                                                <label
                                                    for="productDescription"
                                                    class="form-label fw-semibold"
                                                >
                                                    Description
                                                </label>

                                                <textarea
                                                    name="description"
                                                    id="productDescription"
                                                    rows="6"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    placeholder="Enter product description..."
                                                >{{ old('description', $product->description) }}</textarea>

                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div class="form-text">
                                                    Provide useful information about the product’s condition and availability.
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Images Section --}}
                            <div class="col-12 col-lg-4">

                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                                    {{-- Images Header --}}
                                    <div class="card-header bg-white border-bottom px-4 py-3">

                                        <h5 class="fw-semibold text-dark mb-1">
                                            Product Images
                                        </h5>

                                        <p class="text-secondary small mb-0">
                                            View or replace the current images.
                                        </p>

                                    </div>


                                    <div class="card-body p-4">

                                        @php
                                            $images = is_array($product->images)
                                                ? $product->images
                                                : json_decode($product->images, true);

                                            $images = is_array($images)
                                                ? $images
                                                : [];
                                        @endphp


                                        {{-- Current Images --}}
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Current Images
                                            </label>

                                            @if (!empty($images))

                                                <div class="row g-2">

                                                    @foreach ($images as $image)

                                                        <div class="col-4">

                                                            <div class="border rounded-3 bg-light p-1">

                                                                <img
                                                                    src="{{ asset('admins/products/' . $image) }}"
                                                                    alt="{{ $product->name }}"
                                                                    class="img-fluid rounded-2 object-fit-cover w-100"
                                                                    height="90"
                                                                >

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                            @else

                                                <div class="border rounded-3 bg-light text-center p-4">

                                                    <i class="bi bi-image text-secondary fs-2"></i>

                                                    <p class="text-secondary small mb-0 mt-2">
                                                        No current images found.
                                                    </p>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- Replace Images --}}
                                        <div>

                                            <label
                                                for="productImages"
                                                class="form-label fw-semibold"
                                            >
                                                Replace Images
                                            </label>

                                            <input
                                                type="file"
                                                id="productImages"
                                                name="images[]"
                                                class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                                multiple
                                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                            >

                                            @error('images')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            @error('images.*')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-text">
                                                Leave this empty to keep the existing images.
                                            </div>


                                            {{-- New Image Preview --}}
                                            <div
                                                id="imagePreview"
                                                class="row g-2 mt-2"
                                            ></div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Form Buttons --}}
                            <div class="col-12">

                                <div class="card border-0 shadow-sm rounded-4">

                                    <div class="card-body px-4 py-3">

                                        <div class="d-flex flex-column-reverse flex-sm-row align-items-sm-center justify-content-between gap-3">

                                            <p class="text-secondary small mb-0">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Review the information before updating.
                                            </p>

                                            <div class="d-flex flex-column-reverse flex-sm-row gap-2">

                                                <a
                                                    href="{{ route('admin.products.index') }}"
                                                    class="btn btn-light border"
                                                >
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Cancel
                                                </a>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                    <i class="bi bi-check2-circle me-1"></i>
                                                    Update Product
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>


    @include('layouts.admin.script')


    {{-- Image Preview Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('productImages');
            const imagePreview = document.getElementById('imagePreview');

            if (!imageInput || !imagePreview) {
                return;
            }

            imageInput.addEventListener('change', function () {
                imagePreview.innerHTML = '';

                Array.from(this.files).forEach(function (file) {
                    if (!file.type.startsWith('image/')) {
                        return;
                    }

                    const reader = new FileReader();

                    reader.addEventListener('load', function (event) {
                        const column = document.createElement('div');
                        column.className = 'col-4';

                        const container = document.createElement('div');
                        container.className =
                            'border rounded-3 bg-light p-1';

                        const image = document.createElement('img');
                        image.src = event.target.result;
                        image.alt = file.name;
                        image.width = 100;
                        image.height = 90;
                        image.className =
                            'img-fluid rounded-2 object-fit-cover w-100';

                        container.appendChild(image);
                        column.appendChild(container);
                        imagePreview.appendChild(column);
                    });

                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

</body>
