@include('layouts.admin.head')

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                {{-- PAGE HEADER --}}
                <div class="page-header">
                    <h3 class="page-title">My Requests</h3>
                </div>

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
                                            <th>Status</th>
                                            <th>Donor Info</th>
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

                                                <td>
                                                    {{ $request->product->name }}
                                                </td>

                                                <td>
                                                    <img src="{{ asset('admin/products/'.$image) }}"
                                                         width="60" height="60"
                                                         style="object-fit:cover;">
                                                </td>

                                                {{-- STATUS --}}
                                                <td>
                                                    @if($request->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($request->status == 'accepted')
                                                        <span class="badge bg-success">Accepted</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>

                                                {{-- DONOR INFO --}}
                                                <td>
                                                    @if($request->status == 'accepted')
                                                        <strong>{{ $request->donor->name }}</strong><br>
                                                        {{ $request->donor->email }}
                                                    @else
                                                        <span class="text-muted">Hidden</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $request->created_at->format('d M Y') }}
                                                </td>

                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
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