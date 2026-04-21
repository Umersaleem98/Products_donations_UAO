@include('layouts.admin.head')

<title>Add User</title>

<body>

<!-- Overlay -->
<div id="overlay"></div>

@include('layouts.admin.sidebar')
@include('layouts.admin.header')

<!-- ═══════════════════ MAIN ═══════════════════════ -->
<main id="main">
    <div class="content-area">

        <!-- Page Header -->
        <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h1>Add User</h1>
                <p id="dateLabel"></p>
            </div>
        </div>

        @include('layouts.admin.components.alert')

        <!-- Form Card -->
        <div style="background:#ffffff; padding:25px; border-radius:10px; max-width:600px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Enter name"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    
                    @error('name')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="Enter email"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    
                    @error('email')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Password</label>
                    <input type="password" name="password"
                        placeholder="Enter password"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    
                    @error('password')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Role -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Role</label>
                    <select name="role"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="donor">Donor</option>
                        <option value="beneficiary">Beneficiary</option>
                    </select>

                    @error('role')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Phone -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        placeholder="Enter phone"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                </div>

                <!-- Address -->
                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;">Address</label>
                    <textarea name="address"
                        placeholder="Enter address"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ old('address') }}</textarea>
                </div>

                <!-- Status -->
                <div style="margin-bottom:20px;">
                    <label style="font-weight:600;">Status</label>
                    <select name="is_active"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit"
                    style="background:#007bff; color:#fff; padding:10px 20px; border:none; border-radius:6px;">
                    Save User
                </button>

            </form>

        </div>

    </div>
</main>

@include('layouts.admin.script')

</body>
</html>