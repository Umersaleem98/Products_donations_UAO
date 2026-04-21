@include('layouts.admin.head')

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
<div class="content-area">

    <h1>Edit Category</h1>

@include('layouts.admin.components.alert')

    <div style="background:#fff; padding:20px; max-width:400px; border-radius:8px;">

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                style="width:100%; padding:10px; margin-bottom:15px;">

            <button type="submit" style="padding:10px 20px; background:#28a745; color:#fff; border:none;">
                Update
            </button>

            <a href="{{ route('category.index') }}">Cancel</a>

        </form>

    </div>

</div>
</main>

@include('layouts.admin.script')

</body>
</html>