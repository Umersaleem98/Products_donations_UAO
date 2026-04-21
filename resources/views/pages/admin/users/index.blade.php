@include('layouts.admin.head')
<title>Users</title>

<body>

    <div id="overlay"></div>

    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <!-- ═══════════════════ MAIN ═══════════════════════ -->
    <main id="main">
        <div class="content-area">

            <!-- Header -->
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1>Users</h1>
                    <p id="dateLabel"></p>
                </div>

                @include('layouts.admin.components.alert')

                <a href="{{ route('users.create') }}" class="btn btn-sm text-white px-3 py-2"
                    style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
                    <i class="bi bi-plus-lg me-1"></i> Add User
                </a>
            </div>

            <!-- TABLE -->
            <div class="card mt-3" style="border-radius:12px;">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->email }}</td>

                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        <td>{{ $user->phone ?? '-' }}</td>

                                        <td>
                                            @if ($user->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>{{ $user->created_at->format('d M Y') }}</td>
                                        <td>

                                            <!-- Edit -->
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline-block;"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No users found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </main>

    @include('layouts.admin.script')

</body>
