@include('layouts.admin.head')

<title>Incoming Requests</title>

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
                    <h3 class="page-title">Incoming Requests</h3>
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

                                            $beneficiary = $request->beneficiary;
                                            $profile = $beneficiary->beneficiaryProfile ?? null;
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

                                                <strong>{{ $beneficiary->name }}</strong><br>
                                                <small>{{ $beneficiary->email }}</small>

                                                <br>

                                                <button class="btn btn-sm btn-info mt-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#beneficiaryModal{{ $beneficiary->id }}">
                                                    View Profile
                                                </button>

                                            </td>

                                            {{-- STATUS --}}
                                            <td>
                                                @if($request->status == 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>

                                            {{-- ACTION --}}
                                            <td>

                                                <form method="POST"
                                                      action="{{ route('donor.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                </form>

                                                <form method="POST"
                                                      action="{{ route('donor.request.update', $request->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-danger">Reject</button>
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
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        {{-- PROFILE --}}
                                                        <div class="profile-box">

                                                            <img src="{{ $beneficiary->image
                                                                        ? asset('admin/asset/profilephoto/'.$beneficiary->image)
                                                                        : asset('admin/default.png') }}">

                                                            <h5>{{ $beneficiary->name }}</h5>
                                                            <small class="text-muted">{{ $beneficiary->email }}</small>

                                                        </div>

                                                        <hr>

                                                        {{-- BASIC INFO --}}
                                                        <div class="section-title">Basic Information</div>

                                                        <div class="info-box">

                                                            <p><strong>Institution:</strong> {{ optional($profile)->institution ?? '-' }}</p>

                                                            <p><strong>Father Status:</strong> {{ optional($profile)->father_status ?? '-' }}</p>

                                                            <p><strong>Guardian Profession:</strong> {{ optional($profile)->guardian_profession ?? '-' }}</p>

                                                        </div>

                                                        {{-- FINANCIAL --}}
                                                        <div class="section-title">Financial Information</div>

                                                        <div class="info-box">

                                                            <p><strong>Monthly Income:</strong> {{ optional($profile)->monthly_income ?? '-' }}</p>

                                                        </div>

                                                        {{-- LOCATION --}}
                                                        <div class="section-title">Location</div>

                                                        <div class="info-box">

                                                            <p><strong>Province:</strong> {{ optional($profile)->province ?? '-' }}</p>

                                                            <p><strong>Domicile:</strong> {{ optional($profile)->domicile ?? '-' }}</p>

                                                            <p><strong>Home Address:</strong> {{ optional($profile)->home_address ?? '-' }}</p>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

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

@include('layouts.admin.script')

</body>