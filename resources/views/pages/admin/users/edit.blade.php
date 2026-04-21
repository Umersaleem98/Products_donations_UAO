@include('layouts.admin.head')
<title>Edit User</title>

<body>

<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<main id="main">
<div class="content-area">

<div class="page-header">
    <h1>Edit User</h1>
</div>

@include('layouts.admin.components.alert')

<div style="background:#fff; padding:25px; border-radius:10px; max-width:600px;">

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Name -->
    <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" class="form-control mb-2">

    <!-- Email -->
    <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" class="form-control mb-2">

    <!-- Password -->
    <input type="password" name="password" placeholder="New Password (optional)" class="form-control mb-2">

    <!-- Role -->
    <select name="role" class="form-control mb-2">
        <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
        <option value="donor" {{ $user->role=='donor' ? 'selected' : '' }}>Donor</option>
        <option value="beneficiary" {{ $user->role=='beneficiary' ? 'selected' : '' }}>Beneficiary</option>
    </select>

    <!-- Phone -->
    <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Phone" class="form-control mb-2">

    <!-- Address -->
    <textarea name="address" class="form-control mb-2">{{ $user->address }}</textarea>

    <!-- Status -->
    <select name="is_active" class="form-control mb-3">
        <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
    </select>

    <button class="btn btn-primary">Update User</button>

</form>

</div>

</div>
</main>

@include('layouts.admin.script')
</body>