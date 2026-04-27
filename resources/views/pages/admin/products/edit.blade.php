@include('layouts.admin.head')
<title>Admin Product Edit</title>

<body class="h-100">

    <div class="container-fluid">
        <div class="row">

            @include('layouts.admin.sidebar')

            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

                <div class="main-navbar sticky-top bg-white">
                    @include('layouts.admin.header')
                </div>

                <div class="main-content-container container-fluid px-4">

                    <!-- HEADER -->
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12">
                            <h3 class="page-title">Edit Product</h3>
                        </div>
                    </div>

                    <!-- FORM -->
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- ROW 1 -->
                                        <div class="row">

                                            <!-- NAME -->
                                            <div class="col-md-6 mb-3">
                                                <label>Product Name</label>
                                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                                            </div>

                                            <!-- CATEGORY -->
                                            <div class="col-md-6 mb-3">
                                                <label>Category</label>
                                                <select name="category_id" class="form-control" required>
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <!-- ROW 2 -->
                                        <div class="row">

                                            <!-- PRICE -->
                                            <div class="col-md-6 mb-3">
                                                <label>Price</label>
                                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
                                            </div>

                                            <!-- STATUS -->
                                            <div class="col-md-6 mb-3">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- DESCRIPTION -->
                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="4">
                                            {{ $product->description }}
                                            </textarea>
                                        </div>

                                        <!-- CURRENT IMAGES -->
                                        <div class="mb-3">
                                            <label>Current Images</label>
                                            <br>

                                            @php
                                            $images = json_decode($product->images, true);
                                            @endphp

                                            @if(!empty($images))
                                            @foreach($images as $img)
                                            <img src="{{ asset('admin/products/'.$img) }}" width="70" height="70" style="object-fit:cover;margin-right:10px;border-radius:6px;">
                                            @endforeach
                                            @else
                                            <p>No images found</p>
                                            @endif
                                        </div>

                                        <!-- NEW IMAGES -->
                                        <div class="mb-3">
                                            <label>Replace Images (optional)</label>
                                            <input type="file" name="images[]" class="form-control" multiple>
                                        </div>

                                        <!-- BUTTONS -->
                                        <button type="submit" class="btn btn-success">
                                            Update Product
                                        </button>

                                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                            Back
                                        </a>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    @include('layouts.admin.script')
