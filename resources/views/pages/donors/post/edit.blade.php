@include('layouts.admin.head')
<title>Edit Donation</title>

<body>

    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <main id="main">
        <div class="content-area">

            <h1>Edit Donation</h1>

            @include('layouts.admin.components.alert')

            <form action="{{ route('donor.post.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="title" value="{{ $product->title }}" class="form-control mb-2">

                <select name="category_id" class="form-control mb-2">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <textarea name="description" class="form-control mb-2">{{ $product->description }}</textarea>

                <select name="type" class="form-control mb-2">
                    <option value="donate" {{ $product->type == 'donate' ? 'selected' : '' }}>Donation</option>
                    <option value="sale" {{ $product->type == 'sale' ? 'selected' : '' }}>Sale</option>
                </select>

                <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-2">

                <select name="condition" class="form-control mb-2">
                    <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>New</option>
                    <option value="used" {{ $product->condition == 'used' ? 'selected' : '' }}>Used</option>
                </select>

                <!-- Existing Images -->
                <div class="mb-2">
                    @foreach ($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}" width="60" style="margin:5px;">
                    @endforeach
                </div>

                <input type="file" name="images[]" multiple class="form-control mb-2">

                <select name="is_active" class="form-control mb-3">
                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option>
                </select>

                <button class="btn btn-success">Update</button>

            </form>

        </div>
    </main>
</body>
