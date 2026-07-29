@include('layouts.admin.head')

<title>Update Category</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Update Category
                    </h3>

                    <p class="text-secondary small mb-0">
                        Update the name and information for this category.
                    </p>
                </div>

                <a
                    href="{{ route('admin.category.index') }}"
                    class="btn btn-light border d-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Categories</span>
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
                            href="{{ route('admin.category.index') }}"
                            class="text-decoration-none"
                        >
                            Categories
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Update Category
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            <div class="row justify-content-center">

                <div class="col-12 col-lg-9 col-xl-7">

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
                                        Category Information
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Editing category:
                                        <span class="fw-semibold">
                                            {{ $category->name }}
                                        </span>
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Update Form --}}
                        <form
                            action="{{ route('admin.category.update', $category->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')


                            <div class="card-body p-4">

                                {{-- Category Name --}}
                                <div class="mb-4">

                                    <label
                                        for="categoryName"
                                        class="form-label fw-semibold"
                                    >
                                        Category Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-tag"></i>
                                        </span>

                                        <input
                                            type="text"
                                            id="categoryName"
                                            name="name"
                                            value="{{ old('name', $category->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter category name"
                                            required
                                            autofocus
                                        >

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="form-text">
                                        Enter a clear category name, such as
                                        Electronics, Books or Clothing.
                                    </div>

                                </div>


                                {{-- Current Information --}}
                                <div class="rounded-3 border bg-light p-3">

                                    <div class="row g-3">

                                        <div class="col-12 col-md-6">
                                            <small class="d-block text-secondary mb-1">
                                                Current slug
                                            </small>

                                            <span class="fw-semibold text-dark">
                                                {{ $category->slug }}
                                            </span>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <small class="d-block text-secondary mb-1">
                                                Created
                                            </small>

                                            <span class="fw-semibold text-dark">
                                                {{ optional($category->created_at)->format('d M Y') }}
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Card Footer --}}
                            <div class="card-footer bg-white border-top px-4 py-3">

                                <div class="d-flex flex-column-reverse flex-sm-row justify-content-end gap-2">

                                    <a
                                        href="{{ route('admin.category.index') }}"
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
                                        Update Category
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </main>

    </div>


    @include('layouts.admin.script')

</body>
