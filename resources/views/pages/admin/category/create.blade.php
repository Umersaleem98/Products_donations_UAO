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

            <!-- Success Message -->
            @if(session('success'))
                <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div style="background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-bottom:15px;">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
            <div style="background:#ffffff; padding:25px; border-radius:10px; max-width:500px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <!-- Category Name -->
                    <div style="margin-bottom:20px;">
                        <label style="font-weight:600; margin-bottom:5px; display:block;">
                            Category Name
                        </label>

                        <input 
                            type="text" 
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter category name"
                            required
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;"
                        >
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit"
                            style="background:#007bff; color:#fff; padding:10px 20px; border:none; border-radius:6px; cursor:pointer;"
                        >
                            Save Category
                        </button>
                    </div>

                </form>

            </div>

        </div><!-- /content-area -->
    </main>

    {{-- Scripts --}}
    @include('layouts.admin.script')

</body>
</html>