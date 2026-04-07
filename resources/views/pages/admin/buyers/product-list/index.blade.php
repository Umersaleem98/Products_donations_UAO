@include('layouts.admin.head')
<title>Available Donations</title>

<body>
<div class="container-fluid position-relative d-flex p-0">

    @include('layouts.admin.sidebar')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.admin.header')

        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded p-4">
                <h4 class="mb-4">Available Products for Students</h4>

                <div class="row g-4">

                    @foreach([
                        ['Laptop Dell i5','Good condition laptop for students learning and assignments','Ali Khan','03001234567','Available'],
                        ['HP Laptop i3','Basic laptop for study, online classes and practice','Ahmed Raza','03111234567','Available'],
                        ['Programming Books','Collection of coding books for beginners and learners','Usman Ali','03221234567','Available'],
                        ['Samsung Tablet','Useful tablet for online classes and digital learning','Hassan Khan','03331234567','Reserved'],
                        ['School Books','Complete school books set for class 9 and 10','Bilal Ahmed','03441234567','Available'],
                        ['Lenovo Laptop','Lightweight laptop perfect for students daily tasks','Zain Ali','03551234567','Available'],
                        ['Graphic Tablet','Best for design students and creative learning','Saad Khan','03661234567','Reserved'],
                        ['Headphones','Helpful for attending online lectures clearly','Umar Farooq','03771234567','Available'],
                        ['Keyboard Mouse','Essential accessories for computer usage','Shahzaib','03881234567','Available']
                    ] as $key => $product)

                    <!-- Card -->
                    <div class="col-md-4">
                        <div class="card bg-dark text-white h-100 shadow-sm">
                            <img src="{{ asset('templates/images/banner2.jpg') }}" class="card-img-top" height="180">

                            <div class="card-body">
                                <h5 class="card-title">{{ $product[0] }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($product[1], 60) }}
                                </p>

                                <span class="badge {{ $product[4] == 'Available' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $product[4] }}
                                </span>
                            </div>

                            <div class="card-footer text-center">
                                <button class="btn btn-primary w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#productModal{{ $key }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="productModal{{ $key }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-white">

                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $product[0] }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <img src="{{ asset('templates/images/banner2.jpg') }}" class="img-fluid mb-3">

                                    <p><strong>Description:</strong><br>{{ $product[1] }}</p>
                                    <p><strong>Donor:</strong> {{ $product[2] }}</p>
                                    <p><strong>Contact:</strong> {{ $product[3] }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        <span class="badge {{ $product[4] == 'Available' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $product[4] }}
                                        </span>
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary">Request Item</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>

    </div>
    <!-- Content End -->

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>
</div>

@include('layouts.admin.script')