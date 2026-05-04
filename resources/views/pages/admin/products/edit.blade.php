@include('layouts.admin.head')
<title>Update products</title>
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
                            </span> Dashboard
                        </h3>
                    </div>

                    <!-- FORM -->
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST"
                                          action="{{ route('admin.products.update', $product->id) }}"
                                          enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- ROW 1 -->
                                        <div class="row">

                                            <!-- NAME -->
                                            <div class="col-md-6 mb-3">
                                                <label>Product Name</label>
                                                <input type="text"
                                                       name="name"
                                                       value="{{ $product->name }}"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter product name..."
                                                       required>
                                            </div>

                                            <!-- CATEGORY -->
                                            <div class="col-md-6 mb-3">
                                                <label>Category</label>
                                                <select name="category_id"
                                                        class="form-control form-control-sm"
                                                        required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <!-- ROW 2 -->
                                        <div class="row">

                                            <!-- STATUS -->
                                            <div class="col-md-6 mb-3">
                                                <label>Status</label>
                                                <select name="status"
                                                        class="form-control form-control-sm">
                                                    <option value="">Select status</option>
                                                    <option value="active"
                                                        {{ $product->status == 'active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="inactive"
                                                        {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- DESCRIPTION -->
                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea name="description"
                                                      class="form-control form-control-sm"
                                                      rows="4"
                                                      placeholder="Enter product description...">{{ $product->description }}</textarea>
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
                                                    <img src="{{ asset('admin/products/'.$img) }}"
                                                         width="70"
                                                         height="70"
                                                         style="object-fit:cover;margin-right:10px;border-radius:6px;">
                                                @endforeach
                                            @else
                                                <p>No images found</p>
                                            @endif
                                        </div>

                                        <!-- NEW IMAGES -->
                                        <div class="mb-3">
                                            <label>Replace Images (optional)</label>
                                            <input type="file"
                                                   name="images[]"
                                                   class="form-control form-control-sm"
                                                   multiple>
                                        </div>

                                        <!-- BUTTONS -->
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Update Product
                                        </button>

                                        <a href="{{ route('admin.products.index') }}"
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

@include('layouts.admin.script')