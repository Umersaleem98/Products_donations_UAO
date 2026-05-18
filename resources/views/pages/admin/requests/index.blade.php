@include('layouts.admin.head')

<title>Admin Request Approval</title>

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
                    <h3 class="page-title">Admin Request Approval</h3>
                </div>

                <div class="container mt-3">

                 @include('layouts.admin.alert')

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

                                            $beneficiary = $request->beneficiary;
                                            $donor = $request->donor;

                                            $bProfile = $beneficiary->beneficiaryProfile ?? null;
                                            $dProfile = $donor->donorProfile ?? null;
                                        @endphp

                                        <tr>

                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $request->product->name }}</td>

                                            <td>
                                                <img src="{{ asset('admin/products/'.$image) }}"
                                                     width="60" height="60"
                                                     style="object-fit:cover;">
                                            </td>

                                            {{-- BENEFICIARY --}}
                                            <td>

                                                <button class="btn btn-sm btn-info mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#beneficiaryModal{{ $beneficiary->id }}">
                                                    View Beneficiary
                                                </button>

                                                <button class="btn btn-sm btn-primary mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#donorModal{{ $donor->id }}">
                                                    View Donor
                                                </button>

                                            </td>

                                            {{-- ADMIN STATUS --}}
                                            <td>
                                                @if($request->admin_status == 'pending')
                                                    <span class="badge bg-warning text-light">Pending</span>
                                                @elseif($request->admin_status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Disapproved</span>
                                                @endif
                                            </td>

                                            {{-- DONOR STATUS --}}
                                            <td>
                                                @if($request->donor_status == 'pending')
                                                    <span class="badge bg-info">Waiting</span>
                                                @elseif($request->donor_status == 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @else
                                                    <span class="badge bg-danger">Disapproved</span>
                                                @endif
                                            </td>

                                            {{-- ACTION --}}
                                            <td>

                                                <form method="POST"
                                                      action="{{ route('admin.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="btn btn-sm btn-success">Approve</button>
                                                </form>

                                                <form method="POST"
                                                      action="{{ route('admin.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-danger">Disapproved</button>
                                                </form>

                                            </td>

                                            <td>{{ $request->created_at->format('d M Y') }}</td>

                                        </tr>

                                        {{-- ================= BENEFICIARY MODAL ================= --}}
                                        <div class="modal fade"
                                             id="beneficiaryModal{{ $beneficiary->id }}"
                                             tabindex="-1">

                                            <div class="modal-dialog modal-md modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Beneficiary Profile</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="profile-box">
                                                            <img src="{{ $beneficiary->image
                                                                        ? asset('admin/asset/profilephoto/'.$beneficiary->image)
                                                                        : asset('admin/default.png') }}">
                                                            <h5>{{ $beneficiary->name }}</h5>
                                                            <small>{{ $beneficiary->email }}</small>
                                                        </div>

                                                        <hr>

                                                        <div class="section-title">Basic Info</div>

                                                        <div class="info-box">
                                                            <p><strong>Institution:</strong> {{ optional($bProfile)->institution ?? '-' }}</p>
                                                            <p><strong>Father Status:</strong> {{ optional($bProfile)->father_status ?? '-' }}</p>
                                                            <p><strong>Guardian Profession:</strong> {{ optional($bProfile)->guardian_profession ?? '-' }}</p>
                                                        </div>

                                                        <div class="section-title">Location</div>

                                                        <div class="info-box">
                                                            <p><strong>Province:</strong> {{ optional($bProfile)->province ?? '-' }}</p>
                                                            <p><strong>Domicile:</strong> {{ optional($bProfile)->domicile ?? '-' }}</p>
                                                            <p><strong>Address:</strong> {{ optional($bProfile)->home_address ?? '-' }}</p>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        {{-- ================= DONOR MODAL ================= --}}
                                        <div class="modal fade"
                                             id="donorModal{{ $donor->id }}"
                                             tabindex="-1">

                                            <div class="modal-dialog modal-md modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Donor Profile</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="profile-box">
                                                            <img src="{{ $donor->image
                                                                        ? asset('admin/asset/profilephoto/'.$donor->image)
                                                                        : asset('admin/default.png') }}">
                                                            <h5>{{ $donor->name }}</h5>
                                                            <small>{{ $donor->email }}</small>
                                                        </div>

                                                        <hr>

                                                        <div class="section-title">Basic Info</div>

                                                        <div class="info-box">
                                                            <p><strong>Organization:</strong> {{ optional($dProfile)->organization ?? '-' }}</p>
                                                            <p><strong>Designation:</strong> {{ optional($dProfile)->designation ?? '-' }}</p>
                                                            <p><strong>Country:</strong> {{ optional($dProfile)->country ?? '-' }}</p>
                                                        </div>

                                                        <div class="section-title">Contact Info</div>

                                                        <div class="info-box">
                                                            <p><strong>Address:</strong> {{ optional($dProfile)->address ?? '-' }}</p>
                                                            <p><strong>Email:</strong> {{ $donor->email }}</p>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @empty

                                        <tr>
                                            <td colspan="8" class="text-center">No requests found.</td>
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