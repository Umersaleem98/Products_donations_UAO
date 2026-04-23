@include('layouts.admin.head')

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
    <div class="content-area">

        <!-- PAGE HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Product Detail</h1>
        </div>

        <!-- ALERTS -->
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

        <!-- PRODUCT CARD -->
        <div class="card shadow-sm border-0 p-3">
            <div class="row g-4">

                <!-- LEFT IMAGE -->
                <div class="col-md-5">
                    <img src="{{ asset('admins/assets/img/dummy.png') }}" width="100%" alt="Product">
                </div>

                <!-- RIGHT CONTENT -->
                <div class="col-md-7 d-flex flex-column justify-content-between">

                    <div>

                        <h2 class="fw-bold">{{ $product->title }}</h2>

                        <span class="badge bg-light text-dark mb-2">
                            {{ $product->category->name ?? 'N/A' }}
                        </span>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <div class="row small mb-3">
                            <div class="col-6">
                                <strong>Type:</strong><br>
                                {{ $product->type }}
                            </div>

                            <div class="col-6">
                                <strong>Condition:</strong><br>
                                {{ $product->condition }}
                            </div>

                            <div class="col-6 mt-2">
                                <strong>Price:</strong><br>
                                {{ $product->price ?? 'N/A' }}
                            </div>
                        </div>

                        <hr>

                        <h5>Donor Information</h5>

                        <p><strong>Name:</strong> {{ $product->user->name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $product->user->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $product->user->phone ?? 'N/A' }}</p>
                        <p><strong>Address:</strong> {{ $product->user->address ?? 'N/A' }}</p>

                    </div>

                    <!-- CONNECTION SYSTEM -->
                    @php
                        $connection = \App\Models\Connection::where([
                            'beneficiary_id' => auth()->id(),
                            'donor_id' => $product->user_id
                        ])->first();
                    @endphp

                    {{-- ONLY BENEFICIARY CAN SEND --}}
                    @if(auth()->check() 
                        && auth()->user()->role === 'beneficiary' 
                        && auth()->id() !== $product->user_id)

                        @if(!$connection)
                            <!-- SEND REQUEST -->
                            <form action="{{ route('connection.send', $product->user_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    Send Connection Request
                                </button>
                            </form>

                        @elseif($connection->status === 'pending')
                            <button class="btn btn-warning w-100 mt-3" disabled>
                                Request Pending
                            </button>

                        @elseif($connection->status === 'accepted')
                            <button class="btn btn-success w-100 mt-3" disabled>
                                Connected
                            </button>

                        @elseif($connection->status === 'rejected')
                            <form action="{{ route('connection.send', $product->user_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 mt-3">
                                    Send Again
                                </button>
                            </form>
                        @endif

                    @endif

                </div>
            </div>
        </div>

    </div>
</main>

@include('layouts.admin.script')

</body>