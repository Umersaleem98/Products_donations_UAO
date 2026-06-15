@include('layouts.admin.head')

<title>Index Products</title>

<style>
    .profile-box {
        text-align: center;
        padding: 20px;
    }

    .profile-box img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eee;
        margin-bottom: 10px;
    }

    .info-box p {
        margin: 6px 0;
        font-size: 14px;
    }

    .section-title {
        font-weight: 700;
        font-size: 16px;
        margin: 15px 0 10px;
        border-left: 4px solid #FABD4D;
        padding-left: 10px;
    }
</style>
<style>
    .product-modal .modal-dialog {
        max-width: 850px;
    }

    .product-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,.15);
    }

    .product-modal-header {
        background: linear-gradient(135deg, #FABD4D, #3C9CE7);
        color: #fff;
        padding: 20px 25px;
    }

    .product-modal-header .modal-title {
        font-size: 22px;
        font-weight: 700;
    }

    .product-modal .modal-body {
        padding: 30px;
    }

    .product-modal .form-label {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .product-modal .form-control,
    .product-modal .form-select {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #dcdcdc;
    }

    .product-modal .form-control:focus,
    .product-modal .form-select:focus {
        box-shadow: 0 0 0 .2rem rgba(75,73,172,.15);
        border-color: #FABD4D;
    }

    .upload-box {
        border: 2px dashed #d3d3d3;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: .3s;
    }

    .upload-box:hover {
        border-color: #FABD4D;
    }

    .preview-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .preview-images img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .product-modal .modal-footer {
        border-top: 1px solid #eee;
        padding: 20px 25px;
    }

    .btn-save-product {
        background: #FABD4D;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
        border: none;
    }

    .btn-save-product:hover {
        background: #3d3b93;
        color: #fff;
    }

    @media(max-width:768px){
        .product-modal .modal-body{
            padding:20px;
        }
    }
</style>

<body>

    <div class="container-scroller">

        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.admin.sidebar')

            <div class="main-panel">

                <div class="content-wrapper">

                    <div class="page-header">

                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-cube"></i>
                            </span>
                            Products
                        </h3>

                        @include('layouts.admin.alert')

                    </div>

                    <!-- TABLE -->
                    <div class="row">

                        <div class="col-12">

                            <div class="card shadow-sm">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5>Products</h5>

                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addProductModal">
                                        + Add Product
                                    </button>

                                </div>

                                <div class="card-body">

                                    <table class="table table-bordered table-hover align-middle">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Added By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($products as $key => $product)
                                                @php
                                                    $images = json_decode($product->images, true);
                                                    $user = $product->user;
                                                @endphp

                                                <tr>

                                                    <td>{{ $key + 1 }}</td>

                                                    {{-- IMAGE --}}
                                                    <td>
                                                        @if (!empty($images))
                                                            <img src="{{ asset('admin/products/' . $images[0]) }}"
                                                                width="60" height="60"
                                                                style="object-fit:cover;border-radius:6px;">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>

                                                    {{-- NAME --}}
                                                    <td>{{ $product->name }}</td>

                                                    {{-- CATEGORY --}}
                                                    <td>{{ $product->category->name ?? 'N/A' }}</td>

                                                    {{-- ADDED BY --}}
                                                    <td>

                                                        <button class="btn btn-sm btn-info mt-1" data-bs-toggle="modal"
                                                            data-bs-target="#userModal{{ $user->id }}">
                                                            View Profile
                                                        </button>

                                                    </td>

                                                    {{-- STATUS --}}
                                                    <td>
                                                        @if ($product->status == 'active')
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>

                                                    {{-- ACTION --}}
                                                    <td>

                                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            Edit
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.products.delete', $product->id) }}"
                                                            method="POST" style="display:inline-block">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">
                                                                Delete
                                                            </button>

                                                        </form>

                                                    </td>

                                                </tr>

                                                {{-- ================= USER PROFILE MODAL ================= --}}
                                                <div class="modal fade" id="userModal{{ $user->id }}"
                                                    tabindex="-1">

                                                    <div class="modal-dialog modal-md modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">User Profile</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="profile-box">

                                                                    <img
                                                                        src="{{ $user->image ? asset('admin/asset/profilephoto/' . $user->image) : asset('admin/default.png') }}">

                                                                    <h5>{{ $user->name }}</h5>
                                                                    <small
                                                                        class="text-muted">{{ $user->email }}</small>

                                                                </div>

                                                                <hr>

                                                                <div class="section-title">Account Info</div>

                                                                <div class="info-box">
                                                                    <p><strong>User ID:</strong> {{ $user->id }}
                                                                    </p>
                                                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                                                </div>

                                                                <div class="section-title">Product Stats</div>

                                                                <div class="info-box">
                                                                    <p>
                                                                        <strong>Total Products:</strong>
                                                                        {{ $user->products->count() ?? 0 }}
                                                                    </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            @empty

                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No products found
                                                    </td>
                                                </tr>
                                            @endforelse

                                        </tbody>

                                    </table>

                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $products->links() }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @include('layouts.admin.script')

</body>


<div class="modal fade product-modal" id="addProductModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="product-modal-header d-flex justify-content-between align-items-center">

                <h5 class="modal-title">
                    <i class="mdi mdi-package-variant me-2"></i>
                    Add New Product
                </h5>

                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('admin.products.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="row">

                        <!-- Category -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Category
                            </label>

                            <select name="category_id"
                                class="form-select"
                                required>

                                <option value="">
                                    Select Category
                                </option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input type="text"
                                name="name"
                                id="product_name"
                                class="form-control"
                                placeholder="Enter product name"
                                required>

                        </div>

                        <!-- Slug -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Product Slug
                            </label>

                            <input type="text"
                                name="slug"
                                id="product_slug"
                                class="form-control"
                                placeholder="Auto generated slug"
                                required>

                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status"
                                class="form-select">

                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-4">

                            <label class="form-label">
                                Product Description
                            </label>

                            <textarea name="description"
                                rows="5"
                                class="form-control"
                                placeholder="Write product details here..."></textarea>

                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-12">

                            <label class="form-label">
                                Product Images
                            </label>

                            <div class="upload-box">

                                <i class="mdi mdi-cloud-upload"
                                    style="font-size:40px;color:#FABD4D"></i>

                                <p class="mt-2 mb-2">
                                    Drag & Drop Images or Click Below
                                </p>

                                <input type="file"
                                    id="productImages"
                                    name="images[]"
                                    class="form-control"
                                    multiple
                                    accept="image/*">

                                <div class="preview-images" id="imagePreview"></div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-save-product">

                        <i class="mdi mdi-content-save"></i>
                        Save Product

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Auto Slug
    let name = document.getElementById('product_name');
    let slug = document.getElementById('product_slug');

    name.addEventListener('keyup', function() {
        slug.value = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    });

    // Image Preview
    document.getElementById('productImages')
        .addEventListener('change', function() {

        let preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        Array.from(this.files).forEach(file => {

            let reader = new FileReader();

            reader.onload = function(e) {

                preview.innerHTML += `
                    <img src="${e.target.result}">
                `;

            }

            reader.readAsDataURL(file);

        });

    });

});
</script>
