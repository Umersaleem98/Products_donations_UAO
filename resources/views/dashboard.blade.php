@include('layouts.admin.head')
<title>Dashboard</title>

<body>
<div class="container-fluid position-relative d-flex p-0">

    @include('layouts.admin.sidebar')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.admin.header')

        <!-- Impact Stats Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">

                <!-- Card -->
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded p-4 h-100 d-flex align-items-center justify-content-between">
                        <i class="fa fa-gift fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Total Donations</p>
                            <h5 class="mb-0">120</h5>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded p-4 h-100 d-flex align-items-center justify-content-between">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Total Donors</p>
                            <h5 class="mb-0">45</h5>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded p-4 h-100 d-flex align-items-center justify-content-between">
                        <i class="fa fa-laptop fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Items Donated</p>
                            <h5 class="mb-0">300</h5>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded p-4 h-100 d-flex align-items-center justify-content-between">
                        <i class="fa fa-graduation-cap fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Students Helped</p>
                            <h5 class="mb-0">80</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Impact Stats End -->

    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>
</div>

@include('layouts.admin.script')