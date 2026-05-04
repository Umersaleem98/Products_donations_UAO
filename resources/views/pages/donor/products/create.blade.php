@include('layouts.admin.head')
<title>Create Products</title>
<body>
    <div class="container-scroller">

        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- HEADER -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Add Donor Product
                        </h3>
                    </div>

                    <!-- FORM -->
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST"
                                          action="{{ route('donor.product.store') }}"
                                          enctype="multipart/form-data">

                                        @csrf

                                        <!-- ROW 1 -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Product Name</label>
                                                <input type="text"
                                                       name="name"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter product name..."
                                                       required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Category</label>
                                                <select name="category_id"
                                                        class="form-control form-control-sm"
                                                        required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- ROW 2 -->
                                        <div class="row">
                                            

                                            <div class="col-md-6 mb-3">
                                                <label>Status</label>
                                                <select name="status"
                                                        class="form-control form-control-sm"
                                                        required>
                                                    <option value="">Select status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- DESCRIPTION -->
                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea name="description"
                                                      class="form-control form-control-sm"
                                                      rows="4"
                                                      placeholder="Enter product description..."></textarea>
                                        </div>

                                        <!-- IMAGES -->
                                        <div class="mb-3">
                                            <label>Product Images</label>
                                            <input type="file"
                                                   name="images[]"
                                                   class="form-control form-control-sm"
                                                   multiple>
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

@include('layouts.admin.script')