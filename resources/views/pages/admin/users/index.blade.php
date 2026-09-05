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


    /*
    |--------------------------------------------------------------------------
    | Role Tabs
    |--------------------------------------------------------------------------
    */

    .users-role-tabs {
        display: flex;
        align-items: center;
        gap: 7px;

        overflow-x: auto;

        padding-bottom: 2px;

        scrollbar-width: thin;
    }


    .users-role-tab {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        min-height: 38px;

        padding: 7px 14px;

        border: 1px solid var(--users-border);
        border-radius: 10px;

        background: #ffffff;

        color: #475467;

        font-size: .82rem;
        font-weight: 600;

        text-decoration: none;

        white-space: nowrap;

        transition: .2s ease;
    }


    .users-role-tab:hover {
        border-color: #b9c9dc;

        background: #f8fafc;

        color: var(--users-primary);
    }


    .users-role-tab.active {
        border-color: var(--users-primary);

        background: var(--users-primary);

        color: #ffffff;

        box-shadow:
            0 5px 15px
            rgba(13, 110, 253, .15);
    }


    .users-role-tab-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 22px;
        height: 22px;

        padding: 0 6px;

        border-radius: 100px;

        background: rgba(0, 0, 0, .06);

        font-size: .7rem;
    }


    .users-role-tab.active
    .users-role-tab-count {
        background:
            rgba(
                255,
                255,
                255,
                .2
            );

        color: #ffffff;
    }


    /*
    |--------------------------------------------------------------------------
    | Status Filters
    |--------------------------------------------------------------------------
    */

    .status-filter-bar {
        display: flex;
        flex-wrap: wrap;

        gap: 7px;
    }


    .status-filter-btn {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        padding: 6px 11px;

        border: 1px solid var(--users-border);
        border-radius: 100px;

        background: white;

        color: #667085;

        font-size: .76rem;
        font-weight: 600;

        text-decoration: none;

        transition: .2s ease;
    }


    .status-filter-btn:hover {
        background: #f8fafc;

        color: #212529;
    }


    .status-filter-btn.active {
        border-color: #212529;

        background: #212529;

        color: white;
    }


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    .users-toolbar-search {
        width: min(100%, 500px);
    }


    .users-search-input {
        min-width: 240px;
    }


    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    .users-table-wrap {
        overflow-x: auto;

        -webkit-overflow-scrolling: touch;

        scrollbar-width: thin;
    }


    .users-table {
        min-width: 1170px;

        table-layout: fixed;
    }


    .users-table thead th {
        position: sticky;

        top: 0;

        z-index: 2;

        padding-top: .6rem !important;
        padding-bottom: .6rem !important;

        border-bottom:
            1px solid
            var(--users-border);

        color:
            var(--users-muted)
            !important;

        font-size: .68rem !important;

        font-weight: 700;

        letter-spacing: .035em;

        text-transform: uppercase;

        white-space: nowrap;
    }


    /*
    |--------------------------------------------------------------------------
    | Smaller Table
    |--------------------------------------------------------------------------
    */

    .users-table tbody td {
        padding-top: .42rem !important;
        padding-bottom: .42rem !important;

        border-color:
            var(--users-border);

        vertical-align: middle;

        font-size: .82rem;
    }


    .users-table tbody tr:last-child td {
        border-bottom: 0;
    }


    .users-table .col-check {
        width: 46px;
    }


    .users-table .col-number {
        width: 50px;
    }


    .users-table .col-user {
        width: 185px;
    }


    .users-table .col-qalam {
        width: 110px;
    }


    .users-table .col-contact {
        width: 220px;
    }


    .users-table .col-role {
        width: 105px;
    }


    .users-table .col-status {
        width: 145px;
    }


    .users-table .col-joined {
        width: 135px;
    }


    .users-table .col-actions {
        width: 165px;
    }


    .user-avatar {
        width: 34px;
        height: 34px;

        object-fit: cover;
    }


    .user-avatar-placeholder {
        width: 34px;
        height: 34px;

        font-size: .75rem;
    }


    .user-contact-value {
        display: inline-block;

        max-width: 205px;

        overflow: hidden;

        text-overflow: ellipsis;

        vertical-align: bottom;

        white-space: nowrap;
    }


    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    .users-actions {
        white-space: nowrap;
    }


    .users-actions form {
        display: inline-flex;

        margin: 0;
    }


    .users-action-btn {
        width: 29px;
        height: 29px;

        min-width: 29px !important;

        padding: 0 !important;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 7px;

        font-size: .74rem;

        transition: .2s ease;
    }


    .users-action-btn i {
        margin: 0 !important;
    }


    .users-action-btn:hover {
        transform: translateY(-1px);

        box-shadow:
            0 4px 10px
            rgba(0, 0, 0, .08);
    }


    /*
    |--------------------------------------------------------------------------
    | Profile Modal
    |--------------------------------------------------------------------------
    */

    .user-profile-modal {
        --bs-modal-width: 1100px;
    }


    .profile-avatar-large {
        width: 115px;
        height: 115px;

        object-fit: cover;
    }


    .profile-avatar-placeholder {
        width: 115px;
        height: 115px;

        font-size: 2.1rem;
    }


    .profile-info-card {
        height: 100%;

        border:
            1px solid
            var(--users-border);

        border-radius: 15px;

        background: #ffffff;

        overflow: hidden;
    }


    .profile-info-card-header {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 14px 16px;

        border-bottom:
            1px solid
            var(--users-border);
    }


    .profile-section-icon {
        width: 37px;
        height: 37px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        flex-shrink: 0;
    }


    .profile-info-row {
        display: flex;

        justify-content: space-between;

        align-items: flex-start;

        gap: 20px;

        padding: 11px 15px;

        border-bottom:
            1px solid
            var(--users-border);
    }


    .profile-info-row:last-child {
        border-bottom: 0;
    }


    .profile-info-row > span {
        flex: 0 0 42%;

        color: #667085;

        font-size: .78rem;
    }


    .profile-info-row > strong {
        flex: 1;

        color: #212529;

        font-size: .79rem;

        font-weight: 600;

        text-align: right;

        overflow-wrap: anywhere;
    }


    /*
    |--------------------------------------------------------------------------
    | Import
    |--------------------------------------------------------------------------
    */

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
        border:
            1px solid
            var(--users-border);

        border-radius: .85rem;

        padding: 1rem;

        height: 100%;

        background: #f8fafc;
    }


    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    .users-pagination .pagination {
        flex-wrap: wrap;

        justify-content: center;

        margin-bottom: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Responsive
    |--------------------------------------------------------------------------
    */

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


        .profile-info-row {
            flex-direction: column;

            gap: 4px;
        }


        .profile-info-row > span,
        .profile-info-row > strong {
            width: 100%;

            flex: none;
        }


        .profile-info-row > strong {
            text-align: left;
        }


        .modal-dialog {
            margin: .6rem;
        }

    }

</style>


<body>


    @include('layouts.admin.sidebar')


    <div class="nsn-main">


        @include('layouts.admin.header')


        <main class="nsn-content">


            <div class="users-page">


                {{-- =================================================
                    PAGE HEADER
                ================================================== --}}
                <div class="users-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">


                    <div>

                        <h3 class="users-page-title fw-bold text-dark mb-1">
                            User Management
                        </h3>


                        <p class="text-secondary small mb-0">
                            View, filter, search, import, export and manage registered users.
                        </p>

                    </div>


                    <div class="users-page-actions d-flex flex-wrap align-items-center gap-2">


                        <a
                            href="{{ route('admin.user.export') }}"
                            class="btn btn-dark d-flex align-items-center gap-2"
                        >

                            <i class="bi bi-download"></i>

                            <span>
                                Export All
                            </span>

                        </a>


                        <a
                            href="{{ route('admin.user.create') }}"
                            class="btn btn-primary d-flex align-items-center gap-2"
                        >

                            <i class="bi bi-person-plus"></i>

                            <span>
                                Add User
                            </span>

                        </a>


                    </div>


                </div>



                {{-- =================================================
                    BREADCRUMB
                ================================================== --}}
                <nav
                    aria-label="breadcrumb"
                    class="mb-4"
                >

                    <ol class="breadcrumb small mb-0">

                        <li class="breadcrumb-item">

                            <a
                                href="{{ route('dashboard') }}"
                                class="text-decoration-none"
                            >

                                <i class="bi bi-house-door me-1"></i>

                                Dashboard

                            </a>

                        </li>


                        <li
                            class="breadcrumb-item active"
                            aria-current="page"
                        >

                            Users

                        </li>

                    </ol>

                </nav>



                @include('layouts.admin.alert')



                {{-- =================================================
                    VALIDATION ERRORS
                ================================================== --}}
                @if ($errors->any())

                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert"
                    >

                        <strong>
                            Please correct the following errors:
                        </strong>


                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    IMPORT USERS
                ================================================== --}}
                <div class="users-card card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body p-4">


                        <div class="row align-items-center g-3">


                            <div class="col-12 col-lg-5">


                                <div class="d-flex align-items-center gap-3">


                                    <span
                                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success flex-shrink-0"
                                        style="width:46px;height:46px;"
                                    >

                                        <i class="bi bi-file-earmark-spreadsheet fs-5"></i>

                                    </span>


                                    <div>

                                        <h5 class="fw-semibold text-dark mb-1">
                                            Import Users
                                        </h5>


                                        <p class="text-secondary small mb-0">
                                            Upload an Excel or CSV file containing user records.
                                        </p>

                                    </div>


                                </div>


                            </div>



                            <div class="col-12 col-lg-7">


                                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2">


                                    <a
                                        href="{{ asset('admins/files/demodataimportfile.xlsx') }}"
                                        class="btn btn-outline-success btn-sm d-inline-flex align-items-center justify-content-center gap-2"
                                        download
                                    >

                                        <i class="bi bi-file-earmark-arrow-down"></i>

                                        Download Template

                                    </a>



                                    <form
                                        action="{{ route('admin.user.import.preview') }}"
                                        method="POST"
                                        id="userImportForm"
                                        class="flex-grow-1"
                                        enctype="multipart/form-data"
                                    >

                                        @csrf


                                        <div class="row g-2">


                                            <div class="col-12 col-md">

                                                <input
                                                    type="file"
                                                    name="file"
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    accept=".xlsx,.xls,.csv"
                                                    required
                                                >


                                                @error('file')

                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>

                                                @enderror

                                            </div>


                                            <div class="col-12 col-md-auto">

                                                <button
                                                    type="submit"
                                                    class="btn btn-success w-100"
                                                    id="userImportButton"
                                                >

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

                </div>



                {{-- =================================================
                    IMPORT PREVIEW
                ================================================== --}}
                @php
                    $importPreview =
                        session('import_preview');
                @endphp


                @if ($importPreview)

                    <div
                        class="modal fade"
                        id="importPreviewModal"
                        tabindex="-1"
                        aria-labelledby="importPreviewModalLabel"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content border-0 shadow-lg">


                                <div class="modal-header">

                                    <div>

                                        <h5
                                            class="modal-title fw-semibold"
                                            id="importPreviewModalLabel"
                                        >
                                            Review User Import
                                        </h5>


                                        <p class="small text-secondary mb-0 mt-1">
                                            Duplicate records are detected using email and Qalam ID.
                                        </p>

                                    </div>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>



                                <div class="modal-body p-4">


                                    <div class="row g-3 mb-4">


                                        <div class="col-6 col-lg-3">

                                            <div class="import-summary-box">

                                                <small class="text-secondary">
                                                    Excel rows
                                                </small>


                                                <h3 class="mb-0 mt-1">

                                                    {{ $importPreview['total'] ?? 0 }}

                                                </h3>

                                            </div>

                                        </div>



                                        <div class="col-6 col-lg-3">

                                            <div class="import-summary-box">

                                                <small class="text-secondary">
                                                    Ready to import
                                                </small>


                                                <h3 class="mb-0 mt-1 text-success">

                                                    {{ $importPreview['clean_count'] ?? 0 }}

                                                </h3>

                                            </div>

                                        </div>



                                        <div class="col-6 col-lg-3">

                                            <div class="import-summary-box">

                                                <small class="text-secondary">
                                                    Duplicates removed
                                                </small>


                                                <h3 class="mb-0 mt-1 text-warning">

                                                    {{
                                                        count(
                                                            $importPreview['duplicates']
                                                            ?? []
                                                        )
                                                    }}

                                                </h3>

                                            </div>

                                        </div>



                                        <div class="col-6 col-lg-3">

                                            <div class="import-summary-box">

                                                <small class="text-secondary">
                                                    Invalid rows removed
                                                </small>


                                                <h3 class="mb-0 mt-1 text-danger">

                                                    {{
                                                        count(
                                                            $importPreview['invalid']
                                                            ?? []
                                                        )
                                                    }}

                                                </h3>

                                            </div>

                                        </div>


                                    </div>



                                    @if (!empty($importPreview['duplicates']))

                                        <div class="alert alert-warning">

                                            <strong>
                                                Duplicate records found.
                                            </strong>

                                            These rows will not be inserted.

                                        </div>


                                        <div class="table-responsive border rounded-3 mb-4">

                                            <table class="table table-sm table-hover align-middle mb-0 import-result-table">


                                                <thead class="table-light">

                                                    <tr>

                                                        <th class="px-3 py-2">
                                                            Row
                                                        </th>

                                                        <th>
                                                            Name
                                                        </th>

                                                        <th>
                                                            Email
                                                        </th>

                                                        <th>
                                                            Qalam ID
                                                        </th>

                                                        <th class="px-3">
                                                            Reason
                                                        </th>

                                                    </tr>

                                                </thead>


                                                <tbody>

                                                    @foreach ($importPreview['duplicates'] as $duplicate)

                                                        <tr>

                                                            <td class="px-3">
                                                                {{ $duplicate['row'] }}
                                                            </td>

                                                            <td>
                                                                {{ $duplicate['name'] ?: '—' }}
                                                            </td>

                                                            <td>
                                                                {{ $duplicate['email'] ?: '—' }}
                                                            </td>

                                                            <td>
                                                                {{ $duplicate['qalam_id'] ?: '—' }}
                                                            </td>

                                                            <td class="px-3 text-warning-emphasis">

                                                                {{
                                                                    implode(
                                                                        ' ',
                                                                        $duplicate['reasons']
                                                                    )
                                                                }}

                                                            </td>

                                                        </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    @endif



                                    @if (!empty($importPreview['invalid']))

                                        <h6 class="fw-semibold mb-3">
                                            Invalid rows
                                        </h6>


                                        <div class="table-responsive border rounded-3">

                                            <table class="table table-sm table-hover align-middle mb-0 import-result-table">


                                                <thead class="table-light">

                                                    <tr>

                                                        <th class="px-3">
                                                            Row
                                                        </th>

                                                        <th>
                                                            Name
                                                        </th>

                                                        <th>
                                                            Email
                                                        </th>

                                                        <th class="px-3">
                                                            Validation errors
                                                        </th>

                                                    </tr>

                                                </thead>


                                                <tbody>

                                                    @foreach ($importPreview['invalid'] as $invalid)

                                                        <tr>

                                                            <td class="px-3">
                                                                {{ $invalid['row'] }}
                                                            </td>

                                                            <td>
                                                                {{ $invalid['name'] ?: '—' }}
                                                            </td>

                                                            <td>
                                                                {{ $invalid['email'] ?: '—' }}
                                                            </td>

                                                            <td class="px-3 text-danger">

                                                                {{
                                                                    implode(
                                                                        ' ',
                                                                        $invalid['errors']
                                                                    )
                                                                }}

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


                                    <form
                                        action="{{ route('admin.user.import.cancel') }}"
                                        method="POST"
                                    >

                                        @csrf


                                        <button
                                            type="submit"
                                            class="btn btn-light border"
                                        >
                                            Cancel Import
                                        </button>

                                    </form>



                                    @if (($importPreview['clean_count'] ?? 0) > 0)

                                        <form
                                            action="{{ route('admin.user.import.confirm') }}"
                                            method="POST"
                                            id="confirmUserImportForm"
                                        >

                                            @csrf


                                            <input
                                                type="hidden"
                                                name="import_token"
                                                value="{{ $importPreview['token'] }}"
                                            >


                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                                id="confirmUserImportButton"
                                            >

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



                {{-- =================================================
                    USERS CARD
                ================================================== --}}
                <div class="users-card card border-0 shadow-sm rounded-4 overflow-hidden">


                    {{-- =============================================
                        HEADER
                    ============================================== --}}
                    <div class="card-header bg-white border-bottom p-0">


                        {{-- Role Tabs --}}
                        <div class="px-4 pt-4 pb-3 border-bottom">


                            <div class="users-role-tabs">


                                {{-- All --}}
                                <a
                                    href="{{ route('admin.user.index', array_filter([
                                        'search' => request('search'),
                                        'status' => request('status'),
                                        'per_page' => request('per_page'),
                                    ])) }}"
                                    class="users-role-tab {{ !request('role') ? 'active' : '' }}"
                                >

                                    <i class="bi bi-people"></i>

                                    All Users


                                    <span class="users-role-tab-count">

                                        {{ $roleCounts['all'] ?? 0 }}

                                    </span>

                                </a>



                                {{-- Beneficiary --}}
                                <a
                                    href="{{ route('admin.user.index', array_filter([
                                        'role' => 'beneficiary',
                                        'status' => request('status'),
                                        'search' => request('search'),
                                        'per_page' => request('per_page'),
                                    ])) }}"
                                    class="users-role-tab {{ request('role') === 'beneficiary' ? 'active' : '' }}"
                                >

                                    <i class="bi bi-mortarboard"></i>

                                    Beneficiary


                                    <span class="users-role-tab-count">

                                        {{ $roleCounts['beneficiary'] ?? 0 }}

                                    </span>

                                </a>



                                {{-- Donor --}}
                                <a
                                    href="{{ route('admin.user.index', array_filter([
                                        'role' => 'donor',
                                        'status' => request('status'),
                                        'search' => request('search'),
                                        'per_page' => request('per_page'),
                                    ])) }}"
                                    class="users-role-tab {{ request('role') === 'donor' ? 'active' : '' }}"
                                >

                                    <i class="bi bi-heart"></i>

                                    Donor


                                    <span class="users-role-tab-count">

                                        {{ $roleCounts['donor'] ?? 0 }}

                                    </span>

                                </a>



                                {{-- Admin --}}
                                <a
                                    href="{{ route('admin.user.index', array_filter([
                                        'role' => 'admin',
                                        'status' => request('status'),
                                        'search' => request('search'),
                                        'per_page' => request('per_page'),
                                    ])) }}"
                                    class="users-role-tab {{ request('role') === 'admin' ? 'active' : '' }}"
                                >

                                    <i class="bi bi-shield-check"></i>

                                    Admin


                                    <span class="users-role-tab-count">

                                        {{ $roleCounts['admin'] ?? 0 }}

                                    </span>

                                </a>


                            </div>


                        </div>



                        {{-- Search + Status --}}
                        <div class="px-4 py-3">


                            <div class="users-card-header d-flex flex-wrap align-items-center justify-content-between gap-3">


                                <div>


                                    <h5 class="fw-semibold text-dark mb-1">

                                        User Profiles

                                    </h5>


                                    <p class="text-secondary small mb-0">

                                        Showing

                                        <strong class="text-dark">

                                            {{ $users->total() }}

                                        </strong>

                                        matching users.

                                    </p>


                                </div>



                                {{-- Search --}}
                                <form
                                    method="GET"
                                    action="{{ route('admin.user.index') }}"
                                    class="users-toolbar-search d-flex flex-wrap align-items-center justify-content-end gap-2"
                                >


                                    @if (request('role'))

                                        <input
                                            type="hidden"
                                            name="role"
                                            value="{{ request('role') }}"
                                        >

                                    @endif


                                    @if (request('status'))

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="{{ request('status') }}"
                                        >

                                    @endif


                                    @if (request('per_page'))

                                        <input
                                            type="hidden"
                                            name="per_page"
                                            value="{{ request('per_page') }}"
                                        >

                                    @endif


                                    <div class="input-group users-search-input">

                                        <span class="input-group-text bg-light">

                                            <i class="bi bi-search"></i>

                                        </span>


                                        <input
                                            type="search"
                                            name="search"
                                            value="{{ request('search') }}"
                                            class="form-control"
                                            placeholder="Search name, email, Qalam ID..."
                                        >

                                    </div>


                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Search
                                    </button>


                                    @if (request()->filled('search'))

                                        <a
                                            href="{{ route('admin.user.index', array_filter([
                                                'role' => request('role'),
                                                'status' => request('status'),
                                                'per_page' => request('per_page'),
                                            ])) }}"
                                            class="btn btn-light border"
                                        >

                                            <i class="bi bi-x-circle"></i>

                                        </a>

                                    @endif


                                </form>


                            </div>



                            {{-- =========================================
                                ACCOUNT STATUS FILTER
                            ========================================== --}}
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-3">


                                <div class="status-filter-bar">


                                    <a
                                        href="{{ route('admin.user.index', array_filter([
                                            'role' => request('role'),
                                            'search' => request('search'),
                                            'per_page' => request('per_page'),
                                        ])) }}"
                                        class="status-filter-btn {{ !request('status') ? 'active' : '' }}"
                                    >

                                        <i class="bi bi-grid"></i>

                                        All Status

                                        <span>

                                            {{ $statusCounts['all'] ?? 0 }}

                                        </span>

                                    </a>



                                    <a
                                        href="{{ route('admin.user.index', array_filter([
                                            'role' => request('role'),
                                            'status' => 'active',
                                            'search' => request('search'),
                                            'per_page' => request('per_page'),
                                        ])) }}"
                                        class="status-filter-btn {{ request('status') === 'active' ? 'active' : '' }}"
                                    >

                                        <i class="bi bi-check-circle text-success"></i>

                                        Active

                                        <span>
                                            {{ $statusCounts['active'] ?? 0 }}
                                        </span>

                                    </a>



                                    <a
                                        href="{{ route('admin.user.index', array_filter([
                                            'role' => request('role'),
                                            'status' => 'suspended',
                                            'search' => request('search'),
                                            'per_page' => request('per_page'),
                                        ])) }}"
                                        class="status-filter-btn {{ request('status') === 'suspended' ? 'active' : '' }}"
                                    >

                                        <i class="bi bi-pause-circle text-warning"></i>

                                        Suspended

                                        <span>
                                            {{ $statusCounts['suspended'] ?? 0 }}
                                        </span>

                                    </a>



                                    <a
                                        href="{{ route('admin.user.index', array_filter([
                                            'role' => request('role'),
                                            'status' => 'blocked',
                                            'search' => request('search'),
                                            'per_page' => request('per_page'),
                                        ])) }}"
                                        class="status-filter-btn {{ request('status') === 'blocked' ? 'active' : '' }}"
                                    >

                                        <i class="bi bi-slash-circle text-danger"></i>

                                        Blocked

                                        <span>
                                            {{ $statusCounts['blocked'] ?? 0 }}
                                        </span>

                                    </a>


                                </div>



                                {{-- Per Page --}}
                                <form
                                    action="{{ route('admin.user.index') }}"
                                    method="GET"
                                >


                                    @foreach (request()->except([
                                        'per_page',
                                        'page'
                                    ]) as $name => $value)

                                        @if (!is_array($value))

                                            <input
                                                type="hidden"
                                                name="{{ $name }}"
                                                value="{{ $value }}"
                                            >

                                        @endif

                                    @endforeach


                                    <select
                                        name="per_page"
                                        class="form-select form-select-sm"
                                        onchange="this.form.submit()"
                                    >

                                        @foreach ([10,20,50,100] as $number)

                                            <option
                                                value="{{ $number }}"
                                                @selected(
                                                    (int) request(
                                                        'per_page',
                                                        20
                                                    ) === $number
                                                )
                                            >

                                                {{ $number }} per page

                                            </option>

                                        @endforeach

                                    </select>


                                </form>


                            </div>


                        </div>


                    </div>



                    {{-- =================================================
                        BULK BAR
                    ================================================== --}}
                    <div class="bg-light border-bottom px-4 py-2">


                        <div class="users-bulk-bar d-flex flex-wrap align-items-center justify-content-between gap-3">


                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-check2-square text-primary"></i>


                                <span class="small text-secondary">

                                    <span
                                        id="selectedCount"
                                        class="fw-semibold text-dark"
                                    >
                                        0
                                    </span>

                                    users selected

                                </span>

                            </div>



                            <div class="users-bulk-actions d-flex flex-wrap align-items-center gap-2">


                                <form
                                    action="{{ route('admin.user.export.selected') }}"
                                    method="POST"
                                    id="bulkExportForm"
                                >

                                    @csrf


                                    <div id="bulkExportIds"></div>


                                    <button
                                        type="submit"
                                        id="exportSelectedButton"
                                        class="btn btn-outline-dark btn-sm"
                                        disabled
                                    >

                                        <i class="bi bi-download me-1"></i>

                                        Export Selected

                                    </button>

                                </form>



                                <form
                                    action="{{ route('admin.user.delete.selected') }}"
                                    method="POST"
                                    id="bulkDeleteForm"
                                >

                                    @csrf


                                    <div id="bulkDeleteIds"></div>


                                    <button
                                        type="submit"
                                        id="deleteSelectedButton"
                                        class="btn btn-outline-danger btn-sm"
                                        disabled
                                    >

                                        <i class="bi bi-trash3 me-1"></i>

                                        Delete Selected

                                    </button>

                                </form>


                            </div>


                        </div>


                    </div>



                    {{-- =================================================
                        USERS TABLE
                    ================================================== --}}
                    <div class="users-table-wrap table-responsive">


                        <table class="users-table table table-sm table-hover align-middle mb-0">


                            <thead class="table-light">

                                <tr>


                                    <th class="col-check px-3">

                                        <div class="form-check mb-0">

                                            <input
                                                type="checkbox"
                                                id="select-all"
                                                class="form-check-input"
                                            >

                                        </div>

                                    </th>


                                    <th class="col-number">
                                        #
                                    </th>


                                    <th class="col-user">
                                        User
                                    </th>


                                    <th class="col-qalam">
                                        Qalam ID
                                    </th>


                                    <th class="col-contact">
                                        Contact
                                    </th>


                                    <th class="col-role">
                                        Role
                                    </th>


                                    <th class="col-status">
                                        Status
                                    </th>


                                    <th class="col-joined">
                                        Joined
                                    </th>


                                    <th class="col-actions px-3 text-end">
                                        Actions
                                    </th>


                                </tr>

                            </thead>



                            <tbody>


                                @forelse ($users as $key => $user)


                                    @php

                                        $role =
                                            strtolower(
                                                $user->role ?? ''
                                            );


                                        $roleBadge =
                                            match ($role) {

                                                'admin' =>
                                                    'bg-success-subtle text-success',

                                                'donor' =>
                                                    'bg-primary-subtle text-primary',

                                                'beneficiary' =>
                                                    'bg-info-subtle text-info-emphasis',

                                                default =>
                                                    'bg-secondary-subtle text-secondary',
                                            };


                                        $accountStatus =
                                            strtolower(
                                                $user->account_status
                                                ?? 'active'
                                            );


                                        $statusBadge =
                                            match ($accountStatus) {

                                                'active' =>
                                                    'bg-success-subtle text-success',

                                                'suspended' =>
                                                    'bg-warning-subtle text-warning-emphasis',

                                                'blocked' =>
                                                    'bg-danger-subtle text-danger',

                                                default =>
                                                    'bg-secondary-subtle text-secondary',
                                            };


                                        $statusIcon =
                                            match ($accountStatus) {

                                                'active' =>
                                                    'bi-check-circle-fill',

                                                'suspended' =>
                                                    'bi-pause-circle-fill',

                                                'blocked' =>
                                                    'bi-slash-circle-fill',

                                                default =>
                                                    'bi-question-circle-fill',
                                            };


                                        $canManageStatus =
                                            auth()->user()->isAdmin()
                                            &&
                                            auth()->id() !== $user->id
                                            &&
                                            !$user->isAdmin();

                                    @endphp



                                    <tr>


                                        {{-- Checkbox --}}
                                        <td class="px-3">


                                            <div class="form-check mb-0">


                                                @if (auth()->id() !== $user->id)

                                                    <input
                                                        type="checkbox"
                                                        value="{{ $user->id }}"
                                                        class="form-check-input user-checkbox"
                                                    >

                                                @else

                                                    <i
                                                        class="bi bi-lock-fill text-secondary"
                                                        title="Your account cannot be selected"
                                                    ></i>

                                                @endif


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


                                            <div class="d-flex align-items-center gap-2">


                                                @if ($user->image)

                                                    <img
                                                        src="{{ asset('admins/asset/profilephoto/' . $user->image) }}"
                                                        alt="{{ $user->name }}"
                                                        class="user-avatar rounded-circle border flex-shrink-0"
                                                    >

                                                @else

                                                    <span
                                                        class="user-avatar-placeholder d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-semibold flex-shrink-0"
                                                    >

                                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                                    </span>

                                                @endif



                                                <div class="min-w-0">


                                                    <div class="fw-semibold text-dark text-truncate">

                                                        {{ $user->name }}


                                                        @if (auth()->id() === $user->id)

                                                            <span class="badge bg-light text-dark border ms-1">

                                                                You

                                                            </span>

                                                        @endif


                                                    </div>


                                                    <small class="text-secondary">

                                                        ID #{{ $user->id }}

                                                    </small>


                                                </div>


                                            </div>


                                        </td>



                                        {{-- Qalam --}}
                                        <td>


                                            @if ($user->qalam_id)

                                                <span class="badge bg-light text-dark border fw-normal">

                                                    {{ $user->qalam_id }}

                                                </span>

                                            @else

                                                <span class="text-secondary small">

                                                    —

                                                </span>

                                            @endif


                                        </td>



                                        {{-- Contact --}}
                                        <td>


                                            <div class="small text-dark mb-1">


                                                <i class="bi bi-envelope text-secondary me-1"></i>


                                                <span
                                                    class="user-contact-value"
                                                    title="{{ $user->email }}"
                                                >

                                                    {{ $user->email }}

                                                </span>


                                            </div>


                                            @if ($user->phone)

                                                <small class="text-secondary">

                                                    <i class="bi bi-telephone me-1"></i>

                                                    {{ $user->phone }}

                                                </small>

                                            @else

                                                <small class="text-secondary">
                                                    No phone
                                                </small>

                                            @endif


                                        </td>



                                        {{-- Role --}}
                                        <td>


                                            <span class="badge rounded-pill {{ $roleBadge }} px-2 py-1">

                                                {{ ucfirst($user->role) }}

                                            </span>


                                        </td>



                                        {{-- Account Status --}}
                                        <td>


                                            <span class="badge rounded-pill {{ $statusBadge }} px-2 py-1">


                                                <i class="bi {{ $statusIcon }} me-1"></i>


                                                {{ ucfirst($accountStatus) }}


                                            </span>


                                            @if (
                                                $accountStatus !== 'active'
                                                &&
                                                $user->status_reason
                                            )

                                                <small
                                                    class="d-block text-secondary mt-1"
                                                    title="{{ $user->status_reason }}"
                                                >

                                                    {{
                                                        \Illuminate\Support\Str::limit(
                                                            $user->status_reason,
                                                            20
                                                        )
                                                    }}

                                                </small>

                                            @endif


                                        </td>



                                        {{-- Joined --}}
                                        <td>


                                            <div class="small text-dark">

                                                <i class="bi bi-calendar3 text-secondary me-1"></i>


                                                {{
                                                    optional(
                                                        $user->created_at
                                                    )->format('d M Y')
                                                }}

                                            </div>


                                        </td>



                                        {{-- Actions --}}
                                        <td class="px-3 text-end">


                                            <div class="users-actions d-inline-flex justify-content-end align-items-center gap-1">


                                                {{-- VIEW --}}
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary btn-sm users-action-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#profileModal{{ $user->id }}"
                                                    title="View complete profile"
                                                >

                                                    <i class="bi bi-eye"></i>

                                                </button>



                                                {{-- STATUS --}}
                                                @if ($canManageStatus)

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary btn-sm users-action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#statusModal{{ $user->id }}"
                                                        title="Manage account status"
                                                    >

                                                        <i class="bi bi-shield-lock"></i>

                                                    </button>

                                                @endif



                                                {{-- EDIT --}}
                                                <a
                                                    href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-outline-warning btn-sm users-action-btn"
                                                    title="Edit user"
                                                >

                                                    <i class="bi bi-pencil-square"></i>

                                                </a>



                                                {{-- DELETE --}}
                                                @if (auth()->id() !== $user->id)

                                                    <form
                                                        action="{{ route('admin.user.destroy', $user->id) }}"
                                                        method="POST"
                                                        class="individual-delete-form"
                                                        data-user-name="{{ $user->name }}"
                                                    >

                                                        @csrf

                                                        @method('DELETE')


                                                        <button
                                                            type="submit"
                                                            class="btn btn-outline-danger btn-sm users-action-btn"
                                                            title="Delete user"
                                                        >

                                                            <i class="bi bi-trash3"></i>

                                                        </button>


                                                    </form>

                                                @endif


                                            </div>


                                        </td>


                                    </tr>


                                @empty


                                    <tr>

                                        <td
                                            colspan="9"
                                            class="text-center py-5"
                                        >


                                            <div class="d-flex flex-column align-items-center">


                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width:64px;height:64px;"
                                                >

                                                    <i class="bi bi-people fs-3"></i>

                                                </span>


                                                <h6 class="fw-semibold text-dark mb-1">

                                                    No users found

                                                </h6>


                                                <p class="text-secondary small mb-3">

                                                    No users match the selected filters.

                                                </p>


                                                <a
                                                    href="{{ route('admin.user.index') }}"
                                                    class="btn btn-primary btn-sm"
                                                >

                                                    <i class="bi bi-arrow-counterclockwise me-1"></i>

                                                    Clear Filters

                                                </a>


                                            </div>


                                        </td>

                                    </tr>


                                @endforelse


                            </tbody>


                        </table>


                    </div>



                    {{-- =================================================
                        PAGINATION
                    ================================================== --}}
                    @if ($users->hasPages())


                        <div class="card-footer bg-white border-top px-4 py-3">


                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">


                                <p class="users-pagination-summary text-secondary small mb-0">

                                    Showing

                                    <strong class="text-dark">

                                        {{ $users->firstItem() }}

                                    </strong>

                                    to

                                    <strong class="text-dark">

                                        {{ $users->lastItem() }}

                                    </strong>

                                    of

                                    <strong class="text-dark">

                                        {{ $users->total() }}

                                    </strong>

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



    {{-- =============================================================
        USER PROFILE MODALS
    ============================================================= --}}
    @foreach ($users as $user)


        @php

            $role =
                strtolower(
                    $user->role ?? ''
                );


            $beneficiaryProfile =
                $user->beneficiaryProfile;


            $donorProfile =
                $user->donorProfile;


            $accountStatus =
                strtolower(
                    $user->account_status
                    ?? 'active'
                );


            $profileStatusBadge =
                match ($accountStatus) {

                    'active' =>
                        'bg-success-subtle text-success',

                    'suspended' =>
                        'bg-warning-subtle text-warning-emphasis',

                    'blocked' =>
                        'bg-danger-subtle text-danger',

                    default =>
                        'bg-secondary-subtle text-secondary',
                };


            $profileRoleBadge =
                match ($role) {

                    'admin' =>
                        'bg-success-subtle text-success',

                    'donor' =>
                        'bg-primary-subtle text-primary',

                    'beneficiary' =>
                        'bg-info-subtle text-info-emphasis',

                    default =>
                        'bg-secondary-subtle text-secondary',
                };

        @endphp



        <div
            class="modal fade"
            id="profileModal{{ $user->id }}"
            tabindex="-1"
            aria-labelledby="profileModalLabel{{ $user->id }}"
            aria-hidden="true"
        >


            <div class="modal-dialog modal-xl user-profile-modal modal-dialog-centered modal-dialog-scrollable">


                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">


                    {{-- =================================================
                        HEADER
                    ================================================== --}}
                    <div class="modal-header bg-white border-bottom px-4 py-3">


                        <div>


                            <h5
                                class="modal-title fw-bold text-dark mb-1"
                                id="profileModalLabel{{ $user->id }}"
                            >

                                User Profile

                            </h5>


                            <p class="text-secondary small mb-0">

                                Complete profile information for user #{{ $user->id }}.

                            </p>


                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>


                    </div>



                    {{-- =================================================
                        BODY
                    ================================================== --}}
                    <div class="modal-body bg-light p-4">


                        {{-- =============================================
                            PROFILE SUMMARY
                        ============================================== --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">


                            <div class="card-body p-4">


                                <div class="row align-items-center g-4">


                                    <div class="col-12 col-lg-auto">


                                        @if ($user->image)

                                            <img
                                                src="{{ asset('admins/asset/profilephoto/' . $user->image) }}"
                                                alt="{{ $user->name }}"
                                                class="profile-avatar-large rounded-circle border border-4 border-white shadow-sm"
                                            >

                                        @else

                                            <span
                                                class="profile-avatar-placeholder d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-bold"
                                            >

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </span>

                                        @endif


                                    </div>



                                    <div class="col">


                                        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">


                                            <div>


                                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">


                                                    <h4 class="fw-bold text-dark mb-0">

                                                        {{ $user->name }}

                                                    </h4>


                                                    <span class="badge rounded-pill {{ $profileRoleBadge }} px-3 py-2">

                                                        {{ ucfirst($role) }}

                                                    </span>


                                                    <span class="badge rounded-pill {{ $profileStatusBadge }} px-3 py-2">

                                                        {{ ucfirst($accountStatus) }}

                                                    </span>


                                                </div>



                                                <p class="text-secondary mb-2">

                                                    <i class="bi bi-envelope me-2"></i>

                                                    {{ $user->email }}

                                                </p>


                                                <p class="text-secondary mb-0">

                                                    <i class="bi bi-telephone me-2"></i>

                                                    {{ $user->phone ?? 'Phone not available' }}

                                                </p>


                                            </div>



                                            <div class="text-lg-end">


                                                <small class="d-block text-secondary">

                                                    User ID

                                                </small>


                                                <strong class="fs-5">

                                                    #{{ $user->id }}

                                                </strong>


                                            </div>


                                        </div>


                                    </div>


                                </div>


                            </div>


                        </div>



                        <div class="row g-4">


                            {{-- =========================================
                                ACCOUNT INFORMATION
                            ========================================== --}}
                            <div class="col-12 col-lg-6">


                                <div class="profile-info-card">


                                    <div class="profile-info-card-header">


                                        <span class="profile-section-icon bg-primary-subtle text-primary">

                                            <i class="bi bi-person-vcard"></i>

                                        </span>


                                        <div>

                                            <h6 class="fw-bold mb-0">

                                                Account Information

                                            </h6>

                                        </div>


                                    </div>



                                    <div class="profile-info-row">

                                        <span>
                                            Full Name
                                        </span>

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                    </div>


                                    <div class="profile-info-row">

                                        <span>
                                            Email Address
                                        </span>

                                        <strong>
                                            {{ $user->email }}
                                        </strong>

                                    </div>


                                    <div class="profile-info-row">

                                        <span>
                                            Phone Number
                                        </span>

                                        <strong>
                                            {{ $user->phone ?? 'Not available' }}
                                        </strong>

                                    </div>


                                    <div class="profile-info-row">

                                        <span>
                                            Role
                                        </span>

                                        <strong class="text-capitalize">

                                            {{ $user->role }}

                                        </strong>

                                    </div>


                                    <div class="profile-info-row">

                                        <span>
                                            Qalam ID
                                        </span>

                                        <strong>

                                            {{ $user->qalam_id ?? 'Not available' }}

                                        </strong>

                                    </div>


                                    <div class="profile-info-row">

                                        <span>
                                            Joined
                                        </span>

                                        <strong>

                                            {{
                                                optional(
                                                    $user->created_at
                                                )->format(
                                                    'd M Y, h:i A'
                                                )
                                                ?? 'Not available'
                                            }}

                                        </strong>

                                    </div>


                                </div>


                            </div>



                            {{-- =========================================
                                ACCOUNT STATUS
                            ========================================== --}}
                            <div class="col-12 col-lg-6">


                                <div class="profile-info-card">


                                    <div class="profile-info-card-header">


                                        <span class="profile-section-icon bg-warning-subtle text-warning-emphasis">

                                            <i class="bi bi-shield-check"></i>

                                        </span>


                                        <h6 class="fw-bold mb-0">

                                            Account Status

                                        </h6>


                                    </div>



                                    <div class="profile-info-row">

                                        <span>
                                            Current Status
                                        </span>

                                        <strong>

                                            <span class="badge {{ $profileStatusBadge }}">

                                                {{ ucfirst($accountStatus) }}

                                            </span>

                                        </strong>

                                    </div>



                                    <div class="profile-info-row">

                                        <span>
                                            Status Reason
                                        </span>

                                        <strong>

                                            {{
                                                $user->status_reason
                                                ?? 'No status reason'
                                            }}

                                        </strong>

                                    </div>



                                    <div class="profile-info-row">

                                        <span>
                                            Last Status Change
                                        </span>

                                        <strong>

                                            {{
                                                optional(
                                                    $user->status_changed_at
                                                )->format(
                                                    'd M Y, h:i A'
                                                )
                                                ?? 'Not available'
                                            }}

                                        </strong>

                                    </div>



                                    <div class="profile-info-row">

                                        <span>
                                            Changed By
                                        </span>

                                        <strong>

                                            {{
                                                $user->statusChangedBy?->name
                                                ?? 'Not available'
                                            }}

                                        </strong>

                                    </div>


                                </div>


                            </div>



                            {{-- =========================================
                                BENEFICIARY INFORMATION
                            ========================================== --}}
                            @if ($role === 'beneficiary')


                                <div class="col-12">


                                    <div class="profile-info-card">


                                        <div class="profile-info-card-header">


                                            <span class="profile-section-icon bg-success-subtle text-success">

                                                <i class="bi bi-mortarboard"></i>

                                            </span>


                                            <div>

                                                <h6 class="fw-bold mb-0">

                                                    Academic Information

                                                </h6>

                                            </div>


                                        </div>



                                        <div class="row g-0">


                                            <div class="col-12 col-lg-6 border-end-lg">


                                                <div class="profile-info-row">

                                                    <span>
                                                        Gender
                                                    </span>

                                                    <strong class="text-capitalize">

                                                        {{
                                                            $beneficiaryProfile?->gender
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Institution
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->institution
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Degree Level
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->degree_level
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Degree Program
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->degree_program
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Department
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->department
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Semester
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->semester
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>


                                            </div>



                                            <div class="col-12 col-lg-6">


                                                <div class="profile-info-row">

                                                    <span>
                                                        CGPA
                                                    </span>

                                                    <strong>

                                                        @if (
                                                            !is_null(
                                                                $beneficiaryProfile?->cgpa
                                                            )
                                                        )

                                                            {{
                                                                number_format(
                                                                    (float) $beneficiaryProfile->cgpa,
                                                                    2
                                                                )
                                                            }}
                                                            / 4.00

                                                        @else

                                                            Not available

                                                        @endif

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Enrollment Year
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->enrollment_year
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Graduation Year
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->graduation_year
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Father Status
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->father_status
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Guardian Profession
                                                    </span>

                                                    <strong>

                                                        {{
                                                            $beneficiaryProfile?->guardian_profession
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="profile-info-row">

                                                    <span>
                                                        Monthly Income
                                                    </span>

                                                    <strong>

                                                        @if (
                                                            !is_null(
                                                                $beneficiaryProfile?->monthly_income
                                                            )
                                                        )

                                                            PKR

                                                            {{
                                                                number_format(
                                                                    (float) $beneficiaryProfile->monthly_income,
                                                                    2
                                                                )
                                                            }}

                                                        @else

                                                            Not available

                                                        @endif

                                                    </strong>

                                                </div>


                                            </div>


                                        </div>


                                    </div>


                                </div>



                                {{-- Location --}}
                                <div class="col-12">


                                    <div class="profile-info-card">


                                        <div class="profile-info-card-header">


                                            <span class="profile-section-icon bg-info-subtle text-info-emphasis">

                                                <i class="bi bi-geo-alt"></i>

                                            </span>


                                            <h6 class="fw-bold mb-0">

                                                Beneficiary Location

                                            </h6>


                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Province
                                            </span>

                                            <strong>

                                                {{
                                                    $beneficiaryProfile?->province
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Domicile
                                            </span>

                                            <strong>

                                                {{
                                                    $beneficiaryProfile?->domicile
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Home Address
                                            </span>

                                            <strong>

                                                {{
                                                    $beneficiaryProfile?->home_address
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>


                                    </div>


                                </div>


                            @endif



                            {{-- =========================================
                                DONOR INFORMATION
                            ========================================== --}}
                            @if ($role === 'donor')


                                <div class="col-12">


                                    <div class="profile-info-card">


                                        <div class="profile-info-card-header">


                                            <span class="profile-section-icon bg-primary-subtle text-primary">

                                                <i class="bi bi-building"></i>

                                            </span>


                                            <h6 class="fw-bold mb-0">

                                                Donor Profile

                                            </h6>


                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Organization
                                            </span>

                                            <strong>

                                                {{
                                                    $donorProfile?->organization
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Designation
                                            </span>

                                            <strong>

                                                {{
                                                    $donorProfile?->designation
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Country
                                            </span>

                                            <strong>

                                                {{
                                                    $donorProfile?->country
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>



                                        <div class="profile-info-row">

                                            <span>
                                                Address
                                            </span>

                                            <strong>

                                                {{
                                                    $donorProfile?->address
                                                    ?? 'Not available'
                                                }}

                                            </strong>

                                        </div>


                                    </div>


                                </div>


                            @endif



                            {{-- =========================================
                                ADMIN PROFILE
                            ========================================== --}}
                            @if ($role === 'admin')


                                <div class="col-12">


                                    <div class="profile-info-card">


                                        <div class="profile-info-card-header">


                                            <span class="profile-section-icon bg-success-subtle text-success">

                                                <i class="bi bi-shield-lock"></i>

                                            </span>


                                            <h6 class="fw-bold mb-0">

                                                Administrator Profile

                                            </h6>


                                        </div>



                                        <div class="p-4">


                                            <div class="alert alert-light border mb-0">


                                                <div class="d-flex gap-3">


                                                    <i class="bi bi-shield-check text-success fs-4"></i>


                                                    <div>


                                                        <h6 class="fw-semibold mb-1">

                                                            System Administrator

                                                        </h6>


                                                        <p class="small text-secondary mb-0">

                                                            This account has administrator privileges.
                                                            Administrative accounts do not require
                                                            beneficiary or donor profile information.

                                                        </p>


                                                    </div>


                                                </div>


                                            </div>


                                        </div>


                                    </div>


                                </div>


                            @endif


                        </div>


                    </div>



                    <div class="modal-footer bg-white border-top px-4 py-3">


                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal"
                        >

                            Close

                        </button>


                        <a
                            href="{{ route('admin.user.edit', $user->id) }}"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-pencil-square me-1"></i>

                            Edit User

                        </a>


                    </div>


                </div>


            </div>


        </div>


    @endforeach



    {{-- =============================================================
        ACCOUNT STATUS MODALS
    ============================================================= --}}
    @foreach ($users as $user)


        @php

            $canManageStatus =
                auth()->user()->isAdmin()
                &&
                auth()->id() !== $user->id
                &&
                !$user->isAdmin();

        @endphp


        @if ($canManageStatus)


            <div
                class="modal fade"
                id="statusModal{{ $user->id }}"
                tabindex="-1"
                aria-labelledby="statusModalLabel{{ $user->id }}"
                aria-hidden="true"
            >


                <div class="modal-dialog modal-dialog-centered">


                    <div class="modal-content border-0 shadow">


                        <form
                            action="{{ route('admin.user.status.update', $user->id) }}"
                            method="POST"
                            class="account-status-form"
                        >


                            @csrf

                            @method('PATCH')



                            <div class="modal-header">


                                <div>


                                    <h5
                                        class="modal-title fw-semibold"
                                        id="statusModalLabel{{ $user->id }}"
                                    >

                                        Manage Account Status

                                    </h5>


                                    <p class="text-secondary small mb-0 mt-1">

                                        Update access for

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                    </p>


                                </div>


                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>


                            </div>



                            <div class="modal-body">


                                {{-- Current --}}
                                <div class="alert alert-light border d-flex align-items-center justify-content-between">


                                    <span class="text-secondary">

                                        Current status

                                    </span>


                                    @switch($user->account_status ?? 'active')


                                        @case('active')

                                            <span class="badge bg-success-subtle text-success">

                                                <i class="bi bi-check-circle-fill me-1"></i>

                                                Active

                                            </span>

                                            @break


                                        @case('suspended')

                                            <span class="badge bg-warning-subtle text-warning-emphasis">

                                                <i class="bi bi-pause-circle-fill me-1"></i>

                                                Suspended

                                            </span>

                                            @break


                                        @case('blocked')

                                            <span class="badge bg-danger-subtle text-danger">

                                                <i class="bi bi-slash-circle-fill me-1"></i>

                                                Blocked

                                            </span>

                                            @break


                                    @endswitch


                                </div>



                                <div class="mb-3">


                                    <label
                                        for="account_status_{{ $user->id }}"
                                        class="form-label fw-semibold"
                                    >

                                        New Account Status

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="account_status"
                                        id="account_status_{{ $user->id }}"
                                        class="form-select account-status-select"
                                        required
                                    >


                                        <option
                                            value="active"
                                            @selected(
                                                ($user->account_status ?? 'active')
                                                === 'active'
                                            )
                                        >

                                            Active — Allow system access

                                        </option>


                                        <option
                                            value="suspended"
                                            @selected(
                                                $user->account_status
                                                === 'suspended'
                                            )
                                        >

                                            Suspended — Temporarily disable access

                                        </option>


                                        <option
                                            value="blocked"
                                            @selected(
                                                $user->account_status
                                                === 'blocked'
                                            )
                                        >

                                            Blocked — Deny system access

                                        </option>


                                    </select>


                                </div>



                                <div class="mb-3">


                                    <label
                                        for="status_reason_{{ $user->id }}"
                                        class="form-label fw-semibold"
                                    >

                                        Reason


                                        <span class="text-danger reason-required-mark">

                                            *

                                        </span>


                                    </label>


                                    <textarea
                                        name="status_reason"
                                        id="status_reason_{{ $user->id }}"
                                        class="form-control status-reason-input"
                                        rows="4"
                                        maxlength="1000"
                                        placeholder="Enter reason for suspending or blocking this user"
                                    >{{ old('status_reason', $user->status_reason) }}</textarea>


                                    <div class="form-text">

                                        A reason is required when suspending or blocking an account.

                                    </div>


                                </div>



                                @if ($user->status_changed_at)


                                    <div class="rounded-3 border bg-light p-3">


                                        <div class="small text-secondary mb-1">


                                            <i class="bi bi-clock-history me-1"></i>


                                            Last changed:


                                            <strong class="text-dark">

                                                {{
                                                    $user->status_changed_at
                                                        ->format(
                                                            'd M Y, h:i A'
                                                        )
                                                }}

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


                                <button
                                    type="button"
                                    class="btn btn-light border"
                                    data-bs-dismiss="modal"
                                >

                                    Cancel

                                </button>


                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

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



    {{-- =============================================================
        PAGE SCRIPTS
    ============================================================= --}}
    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                /*
                |--------------------------------------------------------------------------
                | Import
                |--------------------------------------------------------------------------
                */

                const importForm =
                    document.getElementById(
                        'userImportForm'
                    );

                const importButton =
                    document.getElementById(
                        'userImportButton'
                    );


                if (
                    importForm
                    &&
                    importButton
                ) {

                    importForm.addEventListener(
                        'submit',
                        function () {

                            importButton.disabled =
                                true;


                            importButton.innerHTML =
                                '<span class="spinner-border spinner-border-sm me-1"></span>Checking file...';
                        }
                    );
                }



                const importPreviewModal =
                    document.getElementById(
                        'importPreviewModal'
                    );


                if (
                    importPreviewModal
                    &&
                    window.bootstrap
                ) {

                    bootstrap.Modal
                        .getOrCreateInstance(
                            importPreviewModal
                        )
                        .show();
                }



                const confirmImportForm =
                    document.getElementById(
                        'confirmUserImportForm'
                    );


                const confirmImportButton =
                    document.getElementById(
                        'confirmUserImportButton'
                    );


                if (
                    confirmImportForm
                    &&
                    confirmImportButton
                ) {

                    confirmImportForm
                        .addEventListener(
                            'submit',
                            function () {

                                confirmImportButton.disabled =
                                    true;


                                confirmImportButton.innerHTML =
                                    '<span class="spinner-border spinner-border-sm me-1"></span>Importing users...';
                            }
                        );
                }



                /*
                |--------------------------------------------------------------------------
                | Bulk Selection
                |--------------------------------------------------------------------------
                */

                const selectAll =
                    document.getElementById(
                        'select-all'
                    );


                const userCheckboxes =
                    Array.from(
                        document.querySelectorAll(
                            '.user-checkbox'
                        )
                    );


                const selectedCount =
                    document.getElementById(
                        'selectedCount'
                    );


                const exportSelectedButton =
                    document.getElementById(
                        'exportSelectedButton'
                    );


                const deleteSelectedButton =
                    document.getElementById(
                        'deleteSelectedButton'
                    );


                const bulkExportForm =
                    document.getElementById(
                        'bulkExportForm'
                    );


                const bulkDeleteForm =
                    document.getElementById(
                        'bulkDeleteForm'
                    );


                const bulkExportIds =
                    document.getElementById(
                        'bulkExportIds'
                    );


                const bulkDeleteIds =
                    document.getElementById(
                        'bulkDeleteIds'
                    );



                function getSelectedIds() {

                    return userCheckboxes

                        .filter(
                            function (checkbox) {

                                return checkbox.checked;
                            }
                        )

                        .map(
                            function (checkbox) {

                                return checkbox.value;
                            }
                        );
                }



                function setHiddenIds(
                    container,
                    ids
                ) {

                    if (
                        !container
                    ) {
                        return;
                    }


                    container.innerHTML =
                        '';


                    ids.forEach(
                        function (id) {

                            const input =
                                document.createElement(
                                    'input'
                                );


                            input.type =
                                'hidden';


                            input.name =
                                'ids[]';


                            input.value =
                                id;


                            container.appendChild(
                                input
                            );
                        }
                    );
                }



                function updateBulkActions() {

                    const ids =
                        getSelectedIds();


                    if (
                        selectedCount
                    ) {

                        selectedCount.textContent =
                            ids.length;
                    }


                    if (
                        exportSelectedButton
                    ) {

                        exportSelectedButton.disabled =
                            ids.length === 0;
                    }


                    if (
                        deleteSelectedButton
                    ) {

                        deleteSelectedButton.disabled =
                            ids.length === 0;
                    }


                    if (
                        selectAll
                    ) {

                        selectAll.checked =
                            userCheckboxes.length > 0
                            &&
                            ids.length ===
                            userCheckboxes.length;


                        selectAll.indeterminate =
                            ids.length > 0
                            &&
                            ids.length <
                            userCheckboxes.length;
                    }
                }



                if (
                    selectAll
                ) {

                    selectAll.addEventListener(
                        'change',
                        function () {

                            userCheckboxes.forEach(
                                function (
                                    checkbox
                                ) {

                                    checkbox.checked =
                                        selectAll.checked;
                                }
                            );


                            updateBulkActions();
                        }
                    );
                }



                userCheckboxes.forEach(
                    function (
                        checkbox
                    ) {

                        checkbox.addEventListener(
                            'change',
                            updateBulkActions
                        );
                    }
                );



                if (
                    bulkExportForm
                ) {

                    bulkExportForm
                        .addEventListener(
                            'submit',
                            function (
                                event
                            ) {

                                const ids =
                                    getSelectedIds();


                                if (
                                    ids.length === 0
                                ) {

                                    event.preventDefault();

                                    alert(
                                        'Please select at least one user.'
                                    );

                                    return;
                                }


                                setHiddenIds(
                                    bulkExportIds,
                                    ids
                                );
                            }
                        );
                }



                if (
                    bulkDeleteForm
                ) {

                    bulkDeleteForm
                        .addEventListener(
                            'submit',
                            function (
                                event
                            ) {

                                const ids =
                                    getSelectedIds();


                                if (
                                    ids.length === 0
                                ) {

                                    event.preventDefault();

                                    alert(
                                        'Please select at least one user to delete.'
                                    );

                                    return;
                                }


                                if (
                                    !confirm(
                                        'Are you sure you want to permanently delete '
                                        +
                                        ids.length
                                        +
                                        ' selected user(s)?'
                                    )
                                ) {

                                    event.preventDefault();

                                    return;
                                }


                                setHiddenIds(
                                    bulkDeleteIds,
                                    ids
                                );
                            }
                        );
                }



                /*
                |--------------------------------------------------------------------------
                | Individual Delete
                |--------------------------------------------------------------------------
                */

                document.querySelectorAll(
                    '.individual-delete-form'
                )
                .forEach(
                    function (form) {

                        form.addEventListener(
                            'submit',
                            function (
                                event
                            ) {

                                const userName =
                                    form.dataset.userName
                                    ||
                                    'this user';


                                if (
                                    !confirm(
                                        'Are you sure you want to permanently delete '
                                        +
                                        userName
                                        +
                                        '?'
                                    )
                                ) {

                                    event.preventDefault();
                                }
                            }
                        );
                    }
                );



                /*
                |--------------------------------------------------------------------------
                | Account Status
                |--------------------------------------------------------------------------
                */

                document.querySelectorAll(
                    '.account-status-form'
                )
                .forEach(
                    function (form) {


                        const statusSelect =
                            form.querySelector(
                                '.account-status-select'
                            );


                        const reasonInput =
                            form.querySelector(
                                '.status-reason-input'
                            );


                        const requiredMark =
                            form.querySelector(
                                '.reason-required-mark'
                            );


                        if (
                            !statusSelect
                            ||
                            !reasonInput
                        ) {
                            return;
                        }



                        function updateReasonRequirement() {

                            const requiresReason =
                                statusSelect.value ===
                                'suspended'
                                ||
                                statusSelect.value ===
                                'blocked';


                            reasonInput.required =
                                requiresReason;


                            if (
                                requiredMark
                            ) {

                                requiredMark.classList.toggle(
                                    'd-none',
                                    !requiresReason
                                );
                            }


                            if (
                                !requiresReason
                            ) {

                                reasonInput.value =
                                    '';
                            }
                        }



                        statusSelect
                            .addEventListener(
                                'change',
                                updateReasonRequirement
                            );



                        form.addEventListener(
                            'submit',
                            function (
                                event
                            ) {


                                const selectedStatus =
                                    statusSelect.value;


                                const confirmationMessage =
                                    selectedStatus === 'active'

                                        ? 'Activate this user account?'

                                        : selectedStatus === 'suspended'

                                            ? 'Suspend this user account?'

                                            : 'Block this user account?';


                                if (
                                    !confirm(
                                        confirmationMessage
                                    )
                                ) {

                                    event.preventDefault();
                                }
                            }
                        );


                        updateReasonRequirement();

                    }
                );


                updateBulkActions();

            }
        );

    </script>


</body>