@include('layouts.admin.head')

<title>My Requests</title>

<style>
    .profile-card {
        text-align: center;
        padding: 20px;
    }

    .profile-card img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eee;
        margin-bottom: 10px;
    }

    .profile-info {
        text-align: left;
        margin-top: 15px;
    }

    .profile-info p {
        margin: 6px 0;
        font-size: 14px;
    }

    .donor-btn {
        padding: 5px 12px;
        font-size: 12px;
        border-radius: 6px;
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
                        <h3 class="page-title">My Requests</h3>
                    </div>

                    @include('layouts.admin.alert')

                    <div class="container mt-3">

                        <div class="card shadow-sm">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Image</th>
                                                <th>Donor Status</th>
                                                <th>Donor Info</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($requests as $key => $request)

                                                @php
                                                    $image = json_decode($request->product->images, true);
                                                    $image = $image[0] ?? $request->product->images;
                                                    $donor = $request->donor;
                                                @endphp

                                                <tr>

                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $request->product->name }}</td>

                                                    <td>
                                                        <img src="{{ asset('admin/products/' . $image) }}" width="60"
                                                            height="60" style="object-fit:cover;">
                                                    </td>

                                                    {{-- STATUS --}}
                                                    <td>
                                                        @if ($request->donor_status == 'pending')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                        @elseif($request->donor_status == 'accepted')
                                                            <span class="badge bg-success">Accepted</span>
                                                        @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>

                                                    {{-- DONOR INFO --}}
                                                    <td>

                                                        @if ($request->donor_status == 'accepted')
                                                            <button class="btn btn-primary donor-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#donorModal{{ $request->id }}">
                                                                View Donor
                                                            </button>

                                                            <button class="btn btn-info donor-btn mt-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#messageModal{{ $request->id }}">
                                                                View Message
                                                            </button>
                                                        @else
                                                            <span class="text-muted">Hidden</span>
                                                        @endif

                                                    </td>

                                                    <td>{{ $request->created_at->format('d M Y') }}</td>

                                                </tr>

                                                {{-- ================= DONOR MODAL ================= --}}
                                                @if ($request->status == 'accepted')
                                                    <div class="modal fade" id="donorModal{{ $request->id }}"
                                                        tabindex="-1" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Donor Profile</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="profile-card">

                                                                        <img
                                                                            src="{{ $donor->image ? asset('admin/asset/profilephoto/' . $donor->image) : asset('admin/asset/dummy/dummy.jpg') }}">

                                                                        <h5>{{ $donor->name }}</h5>
                                                                        <small
                                                                            class="text-muted">{{ $donor->email }}</small>

                                                                        <hr>

                                                                        <div class="profile-info">

                                                                            <p><strong>Organization:</strong>
                                                                                {{ $donor->donorProfile->organization ?? '-' }}
                                                                            </p>
                                                                            <p><strong>Designation:</strong>
                                                                                {{ $donor->donorProfile->designation ?? '-' }}
                                                                            </p>
                                                                            <p><strong>Country:</strong>
                                                                                {{ $donor->donorProfile->country ?? '-' }}
                                                                            </p>
                                                                            <p><strong>Phone:</strong>
                                                                                {{ $donor->donorProfile->phone ?? '-' }}
                                                                            </p>
                                                                            <p><strong>Address:</strong>
                                                                                {{ $donor->donorProfile->address ?? '-' }}
                                                                            </p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    {{-- ================= MESSAGE MODAL ================= --}}
                                                    <div class="modal fade" id="messageModal{{ $request->id }}"
                                                        tabindex="-1" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Message from Donor</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    @if (!empty($request->message))
                                                                        <div class="alert alert-info">
                                                                            {{ $request->message }}
                                                                        </div>
                                                                    @else
                                                                        <div class="alert alert-warning">
                                                                            No message yet from donor.
                                                                            <br>
                                                                            You will see it here once donor contacts
                                                                            you.
                                                                        </div>
                                                                    @endif

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif

                                            @empty

                                                <tr>
                                                    <td colspan="6" class="text-center">No requests found.</td>
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

            @include('layouts.admin.script')

</body>
