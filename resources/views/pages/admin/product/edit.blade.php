@include('layouts.admin.head')

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
<div class="content-area">

    <!-- Page Header -->
    <div class="page-header">
        <h1>Edit Product</h1>
    </div>

@include('layouts.admin.components.alert')

    <!-- Form Card -->
    <div style="background:#fff; padding:25px; border-radius:10px; max-width:700px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </div>

            <!-- Description -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Description</label>
                <textarea name="description" rows="4"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Category -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Category</label>
                <select name="category_id"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Type</label>
                <select name="type"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    <option value="sell" {{ old('type', $product->type)=='sell' ? 'selected' : '' }}>Sell</option>
                    <option value="buy" {{ old('type', $product->type)=='buy' ? 'selected' : '' }}>Buy</option>
                </select>
            </div>

            <!-- Price -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Price</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </div>

            <!-- Condition -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:600;">Condition</label>
                <select name="condition"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    <option value="new" {{ old('condition', $product->condition)=='new' ? 'selected' : '' }}>New</option>
                    <option value="used" {{ old('condition', $product->condition)=='used' ? 'selected' : '' }}>Used</option>
                </select>
            </div>

            <!-- Status -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:600;">Status</label>
                <select name="is_active"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    <option value="1" {{ old('is_active', $product->is_active)==1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $product->is_active)==0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Buttons -->
            <div style="display:flex; gap:10px;">
                <button type="submit"
                    style="background:#28a745; color:#fff; padding:10px 20px; border:none; border-radius:6px;">
                    Update Product
                </button>

                <a href="{{ route('products.index') }}"
                    style="background:#6c757d; color:#fff; padding:10px 20px; border-radius:6px; text-decoration:none;">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>
</main>

@include('layouts.admin.script')

</body>
</html>