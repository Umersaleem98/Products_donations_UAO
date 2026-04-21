@include('layouts.admin.head')
<title>Add Donation</title>

<body>

    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <main id="main">
        <div class="content-area">

            <h1>Add Donation</h1>

            @include('layouts.admin.components.alert')

            <form action="{{ route('donor.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="text" name="title" placeholder="Title" class="form-control mb-2">

                <select name="category_id" class="form-control mb-2">
                    <option value="">Select Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>

                <select name="type" class="form-control mb-2">
                    <option value="donate">donate</option>
                    <option value="sale">Sale</option>
                </select>

                <input type="number" name="price" placeholder="Price" class="form-control mb-2">

                <select name="condition" class="form-control mb-2">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>

                <input type="file" name="images[]" multiple class="form-control mb-2">

                <select name="is_active" class="form-control mb-3">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

                <button class="btn btn-primary">Save</button>

            </form>

        </div>
    </main>
</body>
