@include('layouts.admin.head')

<title>Manage Users</title>

<style>
    :root {
        --users-primary: #0d6efd;
        --users-border: #e8edf3;
        --users-muted: #667085;
        --users-surface: #ffffff;
        --users-page: #f6f8fb;
    }

    body {
        background: var(--users-page);
    }

    .users-page {
        width: 100%;
        max-width: 1800px;
        margin-inline: auto;
    }

    .users-card {
        border: 1px solid var(--users-border) !important;
        background: var(--users-surface);
    }

    .users-toolbar-search {
        width: min(100%, 520px);
    }

    .users-search-input {
        min-width: 250px;
    }

    .users-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .users-table {
        min-width: 1450px;
        table-layout: fixed;
    }

    .users-table thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        border-bottom: 1px solid var(--users-border);
        color: var(--users-muted) !important;
        font-size: .72rem !important;
        font-weight: 700;
        letter-spacing: .035em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .users-table tbody td {
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-color: var(--users-border);
        vertical-align: middle;
    }

    .users-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .users-table .col-check { width: 58px; }
    .users-table .col-number { width: 65px; }
    .users-table .col-user { width: 235px; }
    .users-table .col-qalam { width: 130px; }
    .users-table .col-contact { width: 255px; }
    .users-table .col-role { width: 130px; }
    .users-table .col-status { width: 175px; }
    .users-table .col-joined { width: 165px; }
    .users-table .col-actions { width: 250px; }

    .user-avatar {
        width: 44px;
        height: 44px;
        object-fit: cover;
    }

    .user-contact-value {
        display: inline-block;
        max-width: 215px;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: bottom;
        white-space: nowrap;
    }

    .users-actions {
        white-space: nowrap;
    }

    .users-actions .btn {
        min-width: 68px;
    }

    .users-pagination .pagination {
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 0;
    }

    .import-result-table {
        min-width: 760px;
    }

    .import-result-table th {
        white-space: nowrap;
        font-size: .75rem;
        text-transform: uppercase;
        color: var(--users-muted);
    }

    .import-summary-box {
        border: 1px solid var(--users-border);
        border-radius: .85rem;
        padding: 1rem;
        height: 100%;
        background: #f8fafc;
    }

    @media (max-width: 991.98px) {
        .users-page-header,
        .users-card-header,
        .users-bulk-bar {
            align-items: stretch !important;
        }

        .users-page-actions,
        .users-bulk-actions {
            width: 100%;
        }

        .users-page-actions .btn,
        .users-bulk-actions .btn {
            flex: 1 1 auto;
            justify-content: center;
        }

        .users-toolbar-search {
            width: 100%;
        }
    }

    @media (max-width: 575.98px) {
        .nsn-content {
            padding: 1rem !important;
        }

        .users-page-title {
            font-size: 1.35rem;
        }

        .users-card .card-body,
        .users-card .card-header,
        .users-card .card-footer,
        .users-bulk-bar {
            padding: 1rem !important;
        }

        .users-search-input {
            min-width: 0;
        }

        .users-toolbar-search > .input-group {
            flex: 1 0 100%;
        }

        .users-toolbar-search > .btn {
            flex: 1 1 0;
        }

        .users-page-actions,
        .users-bulk-actions {
            display: grid !important;
            grid-template-columns: 1fr;
        }

        .users-pagination-summary {
            text-align: center;
        }

        .modal-dialog {
            margin: .75rem;
        }
    }
</style>

<body>

    @include('layouts.admin.sidebar')

    <div class="nsn-main">

        @include('layouts.admin.header')

        <main class="nsn-content">
          <div class="users-page">

            {{-- Page Header --}}
            <div class="users-page-header d-flex flex-wrap align-items-center
                       justify-content-between gap-3 mb-4">
                <div>
                    <h3 class="users-page-title fw-bold text-dark mb-1">
                        User Management
                    </h3>

                    <p class="text-secondary small mb-0">
                        View, search, import, export and manage registered users.
                    </p>
                </div>

                <div class="users-page-actions d-flex flex-wrap align-items-center gap-2">
                    <a href="{{ route('admin.user.export') }}" class="btn btn-dark d-flex align-items-center gap-2">
                        <i class="bi bi-download"></i>
                        <span>Export All</span>
                    </a>

                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-person-plus"></i>
                        <span>Add User</span>
                    </a>
                </div>
            </div>

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Users
                    </li>
                </ol>
            </nav>

            {{-- Alert Messages --}}
            @include('layouts.admin.alert')

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please correct the following errors:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Import Users --}}
            <div class="users-card card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center g-3">

                        <div class="col-12 col-lg-5">
                            <div class="d-flex align-items-center gap-3">
                                <span
                                    class="d-inline-flex align-items-center
                                           justify-content-center rounded-circle
                                           bg-success-subtle text-success
                                           flex-shrink-0"
                                    style="width: 46px; height: 46px;">
                                    <i class="bi bi-file-earmark-spreadsheet fs-5"></i>
                                </span>

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Import Users
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Upload an Excel or CSV file containing
                                        user records.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-7">
                            <form action="{{ route('admin.user.import.preview') }}" method="POST"
                                id="userImportForm"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row g-2">
                                    <div class="col-12 col-md">
                                        <input type="file" name="file"
                                            class="form-control
                                                @error('file') is-invalid @enderror"
                                            accept=".xlsx,.xls,.csv" required>

                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-auto">
                                        <button type="submit" class="btn btn-success w-100"
                                            id="userImportButton">
                                            <i class="bi bi-cloud-arrow-up me-1"></i>
                                            Import Users
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            @php
                $importPreview = session('import_preview');
            @endphp

            @if ($importPreview)
                <div class="modal fade" id="importPreviewModal" tabindex="-1"
                    aria-labelledby="importPreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title fw-semibold" id="importPreviewModalLabel">
                                        Review User Import
                                    </h5>
                                    <p class="small text-secondary mb-0 mt-1">
                                        Duplicate records are detected using email and Qalam ID.
                                    </p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="row g-3 mb-4">
                                    <div class="col-6 col-lg-3">
                                        <div class="import-summary-box">
                                            <small class="text-secondary">Excel rows</small>
                                            <h3 class="mb-0 mt-1">{{ $importPreview['total'] ?? 0 }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="import-summary-box">
                                            <small class="text-secondary">Ready to import</small>
                                            <h3 class="mb-0 mt-1 text-success">{{ $importPreview['clean_count'] ?? 0 }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="import-summary-box">
                                            <small class="text-secondary">Duplicates removed</small>
                                            <h3 class="mb-0 mt-1 text-warning">{{ count($importPreview['duplicates'] ?? []) }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="import-summary-box">
                                            <small class="text-secondary">Invalid rows removed</small>
                                            <h3 class="mb-0 mt-1 text-danger">{{ count($importPreview['invalid'] ?? []) }}</h3>
                                        </div>
                                    </div>
                                </div>

                                @if (!empty($importPreview['duplicates']))
                                    <div class="alert alert-warning d-flex gap-2 align-items-start">
                                        <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                                        <div>
                                            <strong>Duplicate records found.</strong>
                                            These rows will not be inserted. Click
                                            <strong>Remove Duplicates & Import</strong> to continue with clean records.
                                        </div>
                                    </div>

                                    <h6 class="fw-semibold mb-3">Duplicate rows</h6>
                                    <div class="table-responsive border rounded-3 mb-4">
                                        <table class="table table-sm table-hover align-middle mb-0 import-result-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="px-3 py-2">Row</th>
                                                    <th class="py-2">Name</th>
                                                    <th class="py-2">Email</th>
                                                    <th class="py-2">Qalam ID</th>
                                                    <th class="px-3 py-2">Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($importPreview['duplicates'] as $duplicate)
                                                    <tr>
                                                        <td class="px-3">{{ $duplicate['row'] }}</td>
                                                        <td>{{ $duplicate['name'] ?: 'â€”' }}</td>
                                                        <td>{{ $duplicate['email'] ?: 'â€”' }}</td>
                                                        <td>{{ $duplicate['qalam_id'] ?: 'â€”' }}</td>
                                                        <td class="px-3 text-warning-emphasis">
                                                            {{ implode(' ', $duplicate['reasons']) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if (!empty($importPreview['invalid']))
                                    <h6 class="fw-semibold mb-3">Invalid rows</h6>
                                    <div class="table-responsive border rounded-3">
                                        <table class="table table-sm table-hover align-middle mb-0 import-result-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="px-3 py-2">Row</th>
                                                    <th class="py-2">Name</th>
                                                    <th class="py-2">Email</th>
                                                    <th class="px-3 py-2">Validation errors</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($importPreview['invalid'] as $invalid)
                                                    <tr>
                                                        <td class="px-3">{{ $invalid['row'] }}</td>
                                                        <td>{{ $invalid['name'] ?: 'â€”' }}</td>
                                                        <td>{{ $invalid['email'] ?: 'â€”' }}</td>
                                                        <td class="px-3 text-danger">
                                                            {{ implode(' ', $invalid['errors']) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if (($importPreview['clean_count'] ?? 0) === 0)
                                    <div class="alert alert-danger mb-0">
                                        No valid new users are available to import.
                                    </div>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <form action="{{ route('admin.user.import.cancel') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-light border">Cancel Import</button>
                                </form>

                                @if (($importPreview['clean_count'] ?? 0) > 0)
                                    <form action="{{ route('admin.user.import.confirm') }}" method="POST"
                                        id="confirmUserImportForm">
                                        @csrf
                                        <input type="hidden" name="import_token"
                                            value="{{ $importPreview['token'] }}">
                                        <button type="submit" class="btn btn-success"
                                            id="confirmUserImportButton">
                                            <i class="bi bi-check2-circle me-1"></i>
                                            @if (!empty($importPreview['duplicates']))
                                                Remove Duplicates & Import
                                            @else
                                                Confirm & Import Users
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Users Card --}}
            <div class="users-card card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <div
                        class="users-card-header d-flex flex-wrap align-items-center
                               justify-content-between gap-3">
                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                User Profiles
                            </h5>

                            <p class="text-secondary small mb-0">
                                Total registered users:

                                <span class="fw-semibold text-dark">
                                    {{ $users->total() }}
                                </span>
                            </p>
                        </div>

                        {{-- Search Form --}}
                        <form method="GET" action="{{ route('admin.user.index') }}"
                            class="users-toolbar-search d-flex flex-wrap align-items-center justify-content-end gap-2">
                            <div class="input-group users-search-input">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input type="search" name="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="Search users..." aria-label="Search users">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>

                            @if (request()->filled('search'))
                                <a href="{{ route('admin.user.index') }}" class="btn btn-light border">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Bulk Action Form --}}
                <form method="POST" id="bulkForm">
                    @csrf

                    {{-- Bulk Action Bar --}}
                    <div class="bg-light border-bottom px-4 py-3">
                        <div
                            class="users-bulk-bar d-flex flex-wrap align-items-center
                                   justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check2-square text-primary"></i>

                                <span class="small text-secondary">
                                    <span id="selectedCount" class="fw-semibold text-dark">
                                        0
                                    </span>

                                    users selected
                                </span>
                            </div>

                            <div
                                class="users-bulk-actions d-flex flex-wrap
                                       align-items-center gap-2">
                                <button type="submit" id="exportSelectedButton"
                                    formaction="{{ route('admin.user.export.selected') }}"
                                    class="btn btn-outline-dark btn-sm" disabled>
                                    <i class="bi bi-download me-1"></i>
                                    Export Selected
                                </button>

                                <button type="submit" id="deleteSelectedButton"
                                    formaction="{{ route('admin.user.delete.selected') }}"
                                    class="btn btn-outline-danger btn-sm" disabled
                                    onclick="return confirm(
                                        'Are you sure you want to delete the selected users?'
                                    );">
                                    <i class="bi bi-trash3 me-1"></i>
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Users Table --}}
                    <div class="users-table-wrap table-responsive">
                        <table class="users-table table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="col-check px-4 py-3">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="select-all" class="form-check-input"
                                                aria-label="Select all users">
                                        </div>
                                    </th>

                                    <th class="col-number py-3 text-secondary small">
                                        #
                                    </th>

                                    <th class="col-user py-3 text-secondary small">
                                        User
                                    </th>

                                    <th class="col-qalam py-3 text-secondary small">
                                        Qalam ID
                                    </th>

                                    <th class="col-contact py-3 text-secondary small">
                                        Contact
                                    </th>

                                    <th class="col-role py-3 text-secondary small">
                                        Role
                                    </th>

                                    <th class="col-status py-3 text-secondary small">
                                        Account Status
                                    </th>

                                    <th class="col-joined py-3 text-secondary small">
                                        Joined
                                    </th>

                                    <th
                                        class="col-actions px-4 py-3 text-secondary
                                               small text-end">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $key => $user)
                                    @php
                                        $role = strtolower($user->role ?? '');

                                        $roleBadge = match ($role) {
                                            'admin' => 'bg-success-subtle text-success',

                                            'donor' => 'bg-primary-subtle text-primary',

                                            'beneficiary' => 'bg-info-subtle text-info-emphasis',

                                            default => 'bg-secondary-subtle text-secondary',
                                        };

                                        $accountStatus = strtolower($user->account_status ?? 'active');

                                        $statusBadge = match ($accountStatus) {
                                            'active' => 'bg-success-subtle text-success',

                                            'suspended' => 'bg-warning-subtle text-warning-emphasis',

                                            'blocked' => 'bg-danger-subtle text-danger',

                                            default => 'bg-secondary-subtle text-secondary',
                                        };

                                        $statusIcon = match ($accountStatus) {
                                            'active' => 'bi-check-circle-fill',

                                            'suspended' => 'bi-pause-circle-fill',

                                            'blocked' => 'bi-slash-circle-fill',

                                            default => 'bi-question-circle-fill',
                                        };

                                        $canManageStatus =
                                            auth()->user()->isAdmin() &&
                                            auth()->id() !== $user->id &&
                                            !$user->isAdmin();
                                    @endphp

                                    <tr>
                                        {{-- Checkbox --}}
                                        <td class="px-4">
                                            <div class="form-check mb-0">
                                                <input type="checkbox" name="ids[]" value="{{ $user->id }}"
                                                    class="form-check-input
                                                           user-checkbox"
                                                    aria-label="Select {{ $user->name }}">
                                            </div>
                                        </td>

                                        {{-- Number --}}
                                        <td>
                                            <span class="text-secondary">
                                                {{ $users->firstItem() + $key }}
                                            </span>
                                        </td>

                                        {{-- User --}}
                                        <td>
                                            <div
                                                class="d-flex align-items-center
                                                       gap-3">
                                                @if ($user->image)
                                                    <img src="{{ asset('admins/asset/profilephoto/' . $user->image) }}"
                                                        alt="{{ $user->name }}" width="42" height="42"
                                                        class="user-avatar rounded-circle
                                                               border
                                                               object-fit-cover
                                                               flex-shrink-0">
                                                @else
                                                    <span
                                                        class="d-inline-flex
                                                               align-items-center
                                                               justify-content-center
                                                               rounded-circle
                                                               bg-primary-subtle
                                                               text-primary
                                                               fw-semibold
                                                               flex-shrink-0"
                                                        style="width: 44px; height: 44px;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                @endif

                                                <div>
                                                    <div
                                                        class="fw-semibold
                                                               text-dark">
                                                        {{ $user->name }}

                                                        @if (auth()->id() === $user->id)
                                                            <span
                                                                class="badge
                                                                       bg-light
                                                                       text-dark
                                                                       border
                                                                       ms-1">
                                                                You
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <small class="text-secondary">
                                                        User ID:
                                                        #{{ $user->id }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Qalam ID --}}
                                        <td>
                                            @if ($user->qalam_id)
                                                <span
                                                    class="badge bg-light
                                                           text-dark border
                                                           fw-normal">
                                                    {{ $user->qalam_id }}
                                                </span>
                                            @else
                                                <span class="text-secondary small">
                                                    Not available
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Contact --}}
                                        <td>
                                            <div class="small text-dark mb-1">
                                                <i
                                                    class="bi bi-envelope
                                                           text-secondary me-1"></i>

                                                <span class="user-contact-value" title="{{ $user->email }}">
                                                    {{ $user->email }}
                                                </span>
                                            </div>

                                            @if ($user->phone)
                                                <div class="small text-secondary">
                                                    <i class="bi bi-telephone me-1"></i>

                                                    {{ $user->phone }}
                                                </div>
                                            @else
                                                <small class="text-secondary">
                                                    No phone number
                                                </small>
                                            @endif
                                        </td>

                                        {{-- Role --}}
                                        <td>
                                            <span
                                                class="badge rounded-pill
                                                       {{ $roleBadge }}
                                                       px-3 py-2">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        {{-- Account Status --}}
                                        <td>
                                            <div>
                                                <span
                                                    class="badge rounded-pill
                                                           {{ $statusBadge }}
                                                           px-3 py-2">
                                                    <i class="bi {{ $statusIcon }} me-1"></i>

                                                    {{ ucfirst($accountStatus) }}
                                                </span>
                                            </div>

                                            @if ($accountStatus !== 'active' && $user->status_reason)
                                                <small
                                                    class="d-block
                                                           text-secondary
                                                           mt-1"
                                                    title="{{ $user->status_reason }}">
                                                    {{ \Illuminate\Support\Str::limit($user->status_reason, 30) }}
                                                </small>
                                            @endif
                                        </td>

                                        {{-- Joined Date --}}
                                        <td>
                                            <div class="small text-dark">
                                                <i
                                                    class="bi bi-calendar3
                                                           text-secondary me-1"></i>

                                                {{ optional($user->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($user->created_at)->diffForHumans() }}
                                            </small>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-4 text-end">
                                            <div
                                                class="users-actions d-inline-flex
                                                       flex-wrap
                                                       justify-content-end
                                                       align-items-center gap-2">
                                                @if ($canManageStatus)
                                                    <button type="button"
                                                        class="btn
                                                               btn-outline-primary
                                                               btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#statusModal{{ $user->id }}"
                                                        title="Manage account status">
                                                        <i class="bi bi-shield-lock me-1"></i>
                                                        Status
                                                    </button>
                                                @endif

                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn
                                                           btn-outline-warning
                                                           btn-sm"
                                                    title="Edit user">
                                                    <i
                                                        class="bi
                                                               bi-pencil-square
                                                               me-1"></i>
                                                    Edit
                                                </a>

                                                @if (auth()->id() !== $user->id)
                                                    <button type="button"
                                                        class="btn
                                                               btn-outline-danger
                                                               btn-sm
                                                               delete-user-button"
                                                        title="Delete user"
                                                        data-delete-url="{{ route('admin.user.destroy', $user->id) }}"
                                                        data-user-name="{{ $user->name }}">
                                                        <i
                                                            class="bi
                                                                   bi-trash3
                                                                   me-1"></i>
                                                        Delete
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div
                                                class="d-flex flex-column
                                                       align-items-center">
                                                <span
                                                    class="d-inline-flex
                                                           align-items-center
                                                           justify-content-center
                                                           rounded-circle
                                                           bg-light
                                                           text-secondary
                                                           mb-3"
                                                    style="
                                                        width: 64px;
                                                        height: 64px;
                                                    ">
                                                    <i class="bi bi-people fs-3"></i>
                                                </span>

                                                <h6
                                                    class="fw-semibold
                                                           text-dark mb-1">
                                                    No users found
                                                </h6>

                                                <p
                                                    class="text-secondary
                                                           small mb-3">
                                                    @if (request()->filled('search'))
                                                        No users match your
                                                        search.
                                                    @else
                                                        No registered users
                                                        are available.
                                                    @endif
                                                </p>

                                                @if (request()->filled('search'))
                                                    <a href="{{ route('admin.user.index') }}"
                                                        class="btn
                                                               btn-primary
                                                               btn-sm">
                                                        <i
                                                            class="bi
                                                                   bi-arrow-counterclockwise
                                                                   me-1"></i>
                                                        Clear Search
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.user.create') }}"
                                                        class="btn
                                                               btn-primary
                                                               btn-sm">
                                                        <i
                                                            class="bi
                                                                   bi-person-plus
                                                                   me-1"></i>
                                                        Add User
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

                {{--
                    Individual Delete Form

                    This form is intentionally outside bulkForm so the page
                    never contains invalid nested forms.
                --}}
                <form id="deleteUserForm" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>

                {{-- Pagination --}}
                @if ($users->hasPages())
                    <div class="card-footer bg-white border-top
                               px-4 py-3">
                        <div
                            class="d-flex flex-column flex-md-row
                                   align-items-center
                                   justify-content-between gap-3">
                            <p class="users-pagination-summary text-secondary small mb-0">
                                Showing

                                <span class="fw-semibold text-dark">
                                    {{ $users->firstItem() }}
                                </span>

                                to

                                <span class="fw-semibold text-dark">
                                    {{ $users->lastItem() }}
                                </span>

                                of

                                <span class="fw-semibold text-dark">
                                    {{ $users->total() }}
                                </span>

                                users
                            </p>

                            <div class="users-pagination">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
          </div>

        </main>
    </div>

    {{-- Account Status Modals --}}
    @foreach ($users as $user)

        @php
            $canManageStatus = auth()->user()->isAdmin() && auth()->id() !== $user->id && !$user->isAdmin();
        @endphp

        @if ($canManageStatus)
            <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1"
                aria-labelledby="statusModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">

                        <form
                            action="{{ route('admin.user.status.update', $user->id) }}"
                            method="POST" class="account-status-form">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title fw-semibold" id="statusModalLabel{{ $user->id }}">
                                        Manage Account Status
                                    </h5>

                                    <p class="text-secondary small mb-0 mt-1">
                                        Update access for
                                        <strong>{{ $user->name }}</strong>
                                    </p>
                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                {{-- Current Status --}}
                                <div
                                    class="alert alert-light border
                                           d-flex align-items-center
                                           justify-content-between">
                                    <span class="text-secondary">
                                        Current status
                                    </span>

                                    @switch($user->account_status ?? 'active')
                                        @case('active')
                                            <span
                                                class="badge
                                                       bg-success-subtle
                                                       text-success">
                                                <i
                                                    class="bi
                                                           bi-check-circle-fill
                                                           me-1"></i>
                                                Active
                                            </span>
                                        @break

                                        @case('suspended')
                                            <span
                                                class="badge
                                                       bg-warning-subtle
                                                       text-warning-emphasis">
                                                <i
                                                    class="bi
                                                           bi-pause-circle-fill
                                                           me-1"></i>
                                                Suspended
                                            </span>
                                        @break

                                        @case('blocked')
                                            <span
                                                class="badge
                                                       bg-danger-subtle
                                                       text-danger">
                                                <i
                                                    class="bi
                                                           bi-slash-circle-fill
                                                           me-1"></i>
                                                Blocked
                                            </span>
                                        @break
                                    @endswitch
                                </div>

                                {{-- Account Status --}}
                                <div class="mb-3">
                                    <label for="account_status_{{ $user->id }}" class="form-label fw-semibold">
                                        New Account Status
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="account_status" id="account_status_{{ $user->id }}"
                                        class="form-select
                                               account-status-select"
                                        required>
                                        <option value="active" @selected(($user->account_status ?? 'active') === 'active')>
                                            Active Ã¢â‚¬â€ Allow system access
                                        </option>

                                        <option value="suspended" @selected($user->account_status === 'suspended')>
                                            Suspended Ã¢â‚¬â€ Temporarily disable access
                                        </option>

                                        <option value="blocked" @selected($user->account_status === 'blocked')>
                                            Blocked Ã¢â‚¬â€ Deny system access
                                        </option>
                                    </select>
                                </div>

                                {{-- Status Reason --}}
                                <div class="mb-3">
                                    <label for="status_reason_{{ $user->id }}" class="form-label fw-semibold">
                                        Reason

                                        <span
                                            class="text-danger
                                                   reason-required-mark">
                                            *
                                        </span>
                                    </label>

                                    <textarea name="status_reason" id="status_reason_{{ $user->id }}"
                                        class="form-control
                                               status-reason-input" rows="4"
                                        maxlength="1000" placeholder="Enter the reason for suspending or blocking this user">{{ old('status_reason', $user->status_reason) }}</textarea>

                                    <div class="form-text">
                                        A reason is required when suspending
                                        or blocking an account.
                                    </div>
                                </div>

                                {{-- Last Status Information --}}
                                @if ($user->status_changed_at)
                                    <div class="rounded-3 border bg-light p-3">
                                        <div class="small text-secondary mb-1">
                                            <i class="bi bi-clock-history me-1"></i>

                                            Last changed:

                                            <strong class="text-dark">
                                                {{ $user->status_changed_at->format('d M Y, h:i A') }}
                                            </strong>
                                        </div>

                                        @if ($user->statusChangedBy)
                                            <div class="small text-secondary">
                                                <i class="bi bi-person-check me-1"></i>

                                                Changed by:

                                                <strong class="text-dark">
                                                    {{ $user->statusChangedBy->name }}
                                                </strong>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Update Status
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @include('layouts.admin.script')

    {{-- Select All and Status Form Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const importForm = document.getElementById('userImportForm');
            const importButton = document.getElementById('userImportButton');

            if (importForm && importButton) {
                importForm.addEventListener('submit', function() {
                    importButton.disabled = true;
                    importButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Checking file...';
                });
            }

            const importPreviewModal = document.getElementById('importPreviewModal');

            if (importPreviewModal && window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(importPreviewModal).show();
            }

            const confirmImportForm = document.getElementById('confirmUserImportForm');
            const confirmImportButton = document.getElementById('confirmUserImportButton');

            if (confirmImportForm && confirmImportButton) {
                confirmImportForm.addEventListener('submit', function() {
                    confirmImportButton.disabled = true;
                    confirmImportButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Importing users...';
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Bulk user selection
            |--------------------------------------------------------------------------
            */

            const selectAll = document.getElementById('select-all');

            const userCheckboxes = Array.from(
                document.querySelectorAll('.user-checkbox')
            );

            const selectedCount = document.getElementById(
                'selectedCount'
            );

            const exportButton = document.getElementById(
                'exportSelectedButton'
            );

            const deleteButton = document.getElementById(
                'deleteSelectedButton'
            );

            function updateBulkActions() {
                const checkedUsers = userCheckboxes.filter(
                    function(checkbox) {
                        return checkbox.checked;
                    }
                );

                const checkedCount = checkedUsers.length;

                if (selectedCount) {
                    selectedCount.textContent = checkedCount;
                }

                if (exportButton) {
                    exportButton.disabled = checkedCount === 0;
                }

                if (deleteButton) {
                    deleteButton.disabled = checkedCount === 0;
                }

                if (selectAll) {
                    selectAll.checked =
                        userCheckboxes.length > 0 &&
                        checkedCount === userCheckboxes.length;

                    selectAll.indeterminate =
                        checkedCount > 0 &&
                        checkedCount < userCheckboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener(
                    'change',
                    function() {
                        userCheckboxes.forEach(
                            function(checkbox) {
                                checkbox.checked =
                                    selectAll.checked;
                            }
                        );

                        updateBulkActions();
                    }
                );
            }

            userCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener(
                    'change',
                    updateBulkActions
                );
            });

            updateBulkActions();

            /*
            |--------------------------------------------------------------------------
            | Individual user deletion
            |--------------------------------------------------------------------------
            */

            const deleteUserForm = document.getElementById(
                'deleteUserForm'
            );

            const deleteUserButtons = document.querySelectorAll(
                '.delete-user-button'
            );

            deleteUserButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    if (!deleteUserForm) {
                        return;
                    }

                    const deleteUrl = button.dataset.deleteUrl;
                    const userName = button.dataset.userName || 'this user';

                    const confirmed = confirm(
                        'Are you sure you want to permanently delete ' +
                        userName +
                        '?'
                    );

                    if (!confirmed) {
                        return;
                    }

                    deleteUserForm.action = deleteUrl;
                    deleteUserForm.submit();
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Account status reason validation
            |--------------------------------------------------------------------------
            */

            const statusForms = document.querySelectorAll(
                '.account-status-form'
            );

            statusForms.forEach(function(form) {
                const statusSelect = form.querySelector(
                    '.account-status-select'
                );

                const reasonInput = form.querySelector(
                    '.status-reason-input'
                );

                const requiredMark = form.querySelector(
                    '.reason-required-mark'
                );

                if (!statusSelect || !reasonInput) {
                    return;
                }

                function updateReasonRequirement() {
                    const requiresReason =
                        statusSelect.value === 'suspended' ||
                        statusSelect.value === 'blocked';

                    reasonInput.required = requiresReason;

                    if (requiredMark) {
                        requiredMark.classList.toggle(
                            'd-none',
                            !requiresReason
                        );
                    }

                    if (!requiresReason) {
                        reasonInput.value = '';
                    }
                }

                statusSelect.addEventListener(
                    'change',
                    updateReasonRequirement
                );

                form.addEventListener(
                    'submit',
                    function(event) {
                        const selectedStatus =
                            statusSelect.value;

                        const confirmationMessage =
                            selectedStatus === 'active' ?
                            'Activate this user account?' :
                            selectedStatus === 'suspended' ?
                            'Suspend this user account?' :
                            'Block this user account?';

                        if (!confirm(confirmationMessage)) {
                            event.preventDefault();
                        }
                    }
                );

                updateReasonRequirement();
            });
        });
    </script>

</body>
