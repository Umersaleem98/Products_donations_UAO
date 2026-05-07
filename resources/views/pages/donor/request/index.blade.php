@include('layouts.admin.head')

<title>Incoming Requests</title>

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                <div class="page-header">
                    <h3 class="page-title">Incoming Requests</h3>
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
                                        <th>Status</th>
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

                                            <td>{{ $request->product->name }}</td>

                                            <td>
                                                <img src="{{ asset('admin/products/'.$image) }}"
                                                     width="60" height="60"
                                                     style="object-fit:cover;">
                                            </td>

                                            <td>
                                                <strong>{{ $request->beneficiary->name }}</strong><br>
                                                <small>{{ $request->beneficiary->email }}</small>

                                                <br>

                                                <button class="btn btn-sm btn-info mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#beneficiaryModal{{ $request->beneficiary->id }}">
                                                    View Profile
                                                </button>
                                            </td>

                                            <td>
                                                @if($request->status == 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>

                                            <td>

                                                <form method="POST"
                                                      action="{{ route('donor.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="accepted">

                                                    <button type="submit"
                                                            class="btn btn-sm {{ $request->status == 'accepted' ? 'btn-success' : 'btn-outline-success' }}">
                                                        Accept
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                      action="{{ route('donor.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">

                                                    <button type="submit"
                                                            class="btn btn-sm {{ $request->status == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                        Reject
                                                    </button>
                                                </form>

                                            </td>

                                            <td>
                                                {{ $request->created_at->format('d M Y') }}
                                            </td>

                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
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


{{-- ================= MODALS (MOVED OUTSIDE TABLE - FIXED) ================= --}}
@foreach($requests->unique('beneficiary_id') as $request)

    <div class="modal fade"
         id="beneficiaryModal{{ $request->beneficiary->id }}"
         tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Beneficiary Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <p><strong>Name:</strong> {{ $request->beneficiary->name }}</p>
                    <p><strong>Email:</strong> {{ $request->beneficiary->email }}</p>

                    <hr>

                    <h6>All Requests</h6>

                    <table class="table table-sm table-bordered">

                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($requests->where('beneficiary_id', $request->beneficiary->id) as $r)

                            <tr>
                                <td>{{ $r->product->name }}</td>

                                <td>
                                    @if($r->status == 'accepted')
                                        <span class="badge bg-success">Accepted</span>
                                    @elseif($r->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $r->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endforeach

@include('layouts.admin.script')
</body>