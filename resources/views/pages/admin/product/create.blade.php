@include('layouts.admin.head')

<body>

    <div id="overlay"></div>

    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <main id="main">
        <div class="content-area">

            <!-- Header -->
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1>Add Product</h1>
                    <p id="dateLabel"></p>
                </div>
            </div>


@include('layouts.admin.components.alert')
            <!-- FORM -->
            <div style="background:#fff; padding:25px; border-radius:10px; max-width:700px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <!-- Title -->
                    <div style="margin-bottom:15px;">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            style="width:100%; padding:10px;">
                    </div>

                    <!-- Description -->
                    <div style="margin-bottom:15px;">
                        <label>Description</label>
                        <textarea name="description" rows="4" required style="width:100%; padding:10px;">{{ old('description') }}</textarea>
                    </div>

                    <!-- Category -->
                    <div style="margin-bottom:15px;">
                        <label>Category</label>
                        <select name="category_id" required style="width:100%; padding:10px;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type -->
                    <div style="margin-bottom:15px;">
                        <label>Type</label>
                        <select name="type" required style="width:100%; padding:10px;">
                            <option value="">Select Type</option>
                            <option value="sell">Sell</option>
                            <option value="buy">Buy</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div style="margin-bottom:15px;">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" required
                            style="width:100%; padding:10px;">
                    </div>

                    <!-- Condition -->
                    <div style="margin-bottom:15px;">
                        <label>Condition</label>
                        <select name="condition" required style="width:100%; padding:10px;">
                            <option value="">Select Condition</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                        </select>
                    </div>

                    <!-- Active -->
                    <div style="margin-bottom:15px;">
                        <label>Status</label>
                        <select name="is_active" style="width:100%; padding:10px;">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" style="background:#007bff; color:#fff; padding:10px 20px; border:none;">
                        Save Product
                    </button>

                </form>
            </div>

        </div>
    </main>

    @include('layouts.admin.script')

</body>
</html>