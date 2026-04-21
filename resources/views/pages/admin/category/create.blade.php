@include('layouts.admin.head')

<body>

    <!-- Overlay (mobile) -->
    <div id="overlay"></div>

    {{-- Sidebar & Header --}}
    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <!-- ═══════════════════ MAIN ═══════════════════════ -->
    <main id="main">
        <div class="content-area">

            <!-- Page Header -->
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1>Add Category</h1>
                    <p id="dateLabel"></p>
                </div>
            </div>

            @include('layouts.admin.components.alert')

            <!-- Form Card -->
            <div
                style="background:#ffffff; padding:25px; border-radius:10px; max-width:500px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

            

            </div>

        </div><!-- /content-area -->
    </main>

    {{-- Scripts --}}
    @include('layouts.admin.script')

</body>

</html>
