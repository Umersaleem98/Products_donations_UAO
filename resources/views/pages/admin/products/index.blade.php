@include('layouts.admin.head')

<title>Index Products</title>

<style>

    .profile-box{
        text-align:center;
        padding:20px;
    }

    .profile-box img{
        width:110px;
        height:110px;
        border-radius:50%;
        object-fit:cover;
        border:3px solid #eee;
        margin-bottom:10px;
    }

    .info-box p{
        margin:6px 0;
        font-size:14px;
    }

    .section-title{
        font-weight:700;
        font-size:16px;
        margin:15px 0 10px;
        border-left:4px solid #4B49AC;
        padding-left:10px;
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

                                <a href="{{ route('admin.products.create') }}"
                                   class="btn btn-primary btn-sm">
                                    + Add Product
                                </a>

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
                                                @if(!empty($images))
                                                    <img src="{{ asset('admin/products/'.$images[0]) }}"
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

                                                <strong>{{ $user->name ?? 'N/A' }}</strong><br>
                                                <small>{{ $user->email ?? '' }}</small>

                                                <br>

                                                <button class="btn btn-sm btn-info mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userModal{{ $user->id }}">
                                                    View Profile
                                                </button>

                                            </td>

                                            {{-- STATUS --}}
                                            <td>
                                                @if($product->status == 'active')
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

                                                <form action="{{ route('admin.products.delete', $product->id) }}"
                                                      method="POST"
                                                      style="display:inline-block">

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
                                        <div class="modal fade"
                                             id="userModal{{ $user->id }}"
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

                                                            <img src="{{ $user->image
                                                                        ? asset('admin/asset/profilephoto/'.$user->image)
                                                                        : asset('admin/default.png') }}">

                                                            <h5>{{ $user->name }}</h5>
                                                            <small class="text-muted">{{ $user->email }}</small>

                                                        </div>

                                                        <hr>

                                                        <div class="section-title">Account Info</div>

                                                        <div class="info-box">
                                                            <p><strong>User ID:</strong> {{ $user->id }}</p>
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