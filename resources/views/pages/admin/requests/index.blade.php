@include('layouts.admin.head')

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                {{-- HEADER --}}
                <div class="page-header">
                    <h3 class="page-title">Admin Request Approval</h3>
                </div>

                <div class="container mt-3">

                    {{-- ALERTS --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Beneficiary</th>
                                            <th>Admin Status</th>
                                            <th>Donor Status</th>
                                            <th>Action</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($requests as $key => $request)

                                            @php
                                                $image = json_decode($request->product->images, true);
                                                $image = $image[0] ?? $request->product->images;
                                            @endphp

                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                {{-- PRODUCT --}}
                                                <td>{{ $request->product->name }}</td>

                                                {{-- IMAGE --}}
                                                <td>
                                                    <img src="{{ asset('admin/products/'.$image) }}"
                                                         width="60" height="60"
                                                         style="object-fit:cover;">
                                                </td>

                                                {{-- BENEFICIARY --}}
                                                <td>
                                                    <strong>{{ $request->beneficiary->name }}</strong><br>
                                                    <small>{{ $request->beneficiary->email }}</small>
                                                </td>

                                                {{-- ADMIN STATUS --}}
                                                <td>
                                                    @if($request->admin_status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($request->admin_status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>

                                                {{-- DONOR STATUS --}}
                                                <td>
                                                    @if($request->donor_status == 'pending')
                                                        <span class="badge bg-secondary">Waiting</span>
                                                    @elseif($request->donor_status == 'accepted')
                                                        <span class="badge bg-success">Accepted</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>

                                                {{-- ACTION --}}
                                                <td>

                                                    {{-- APPROVE --}}
                                                    <form method="POST"
                                                          action="{{ route('admin.request.update', $request->id) }}"
                                                          style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">

                                                        <button class="btn btn-sm 
                                                            {{ $request->admin_status == 'approved' ? 'btn-success' : 'btn-outline-success' }}">
                                                            Approve
                                                        </button>
                                                    </form>

                                                    {{-- REJECT --}}
                                                    <form method="POST"
                                                          action="{{ route('admin.request.update', $request->id) }}"
                                                          style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">

                                                        <button class="btn btn-sm 
                                                            {{ $request->admin_status == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                            Reject
                                                        </button>
                                                    </form>

                                                </td>

                                                {{-- DATE --}}
                                                <td>
                                                    {{ $request->created_at->format('d M Y') }}
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No requests found.
                                                </td>
                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>
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