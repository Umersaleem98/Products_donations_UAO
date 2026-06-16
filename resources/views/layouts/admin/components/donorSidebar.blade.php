

<li class="nav-item">

    <a class="nav-link" data-bs-toggle="collapse" href="#donor-product"
       style="{{ (isset($profileCompletion) && $profileCompletion < 85) ? 'opacity:0.5; pointer-events:none;' : '' }}">

        <span class="menu-title">Product</span>
        <i class="menu-arrow"></i>
        <i class="text-primary mdi mdi-cube-outline menu-icon"></i>

    </a>

    @if(isset($profileCompletion) && $profileCompletion < 85)
        <div style="padding-left:55px; margin-top:-5px;">
            <small style="color:#dc3545; font-size:11px;">
                ⚠ Complete profile (85%) to unlock
            </small>
        </div>
    @endif

    <div class="collapse" id="donor-product" data-bs-parent="#sidebar-accordion">

        <ul class="nav flex-column sub-menu">

            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('donor.product.index') }}"
                   style="{{ (isset($profileCompletion) && $profileCompletion < 85) ? 'pointer-events:none; opacity:0.5;' : '' }}">
                    My Products
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('donor.product.create') }}"
                   style="{{ (isset($profileCompletion) && $profileCompletion < 85) ? 'pointer-events:none; opacity:0.5;' : '' }}">
                    Add Product
                </a>
            </li>

        </ul>

    </div>

</li>

<li class="nav-item">

    <a class="nav-link"
       href="{{ route('donor.requests') }}"
       style="{{ (isset($profileCompletion) && $profileCompletion < 85) ? 'opacity:0.5; pointer-events:none;' : '' }}">

        <span class="menu-title">Requests</span>
        <i class="text-primary mdi mdi-clipboard-text menu-icon"></i>

    </a>

    @if(isset($profileCompletion) && $profileCompletion < 85)
        <div style="padding-left:55px; margin-top:-5px;">
            <small style="color:#dc3545; font-size:11px;">
                ⚠ Complete profile to access requests
            </small>
        </div>
    @endif

</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('donor.profile.index') }}">
        <span class="menu-title">Profile</span>
        <i class="text-primary mdi mdi-account-circle menu-icon"></i>
    </a>
</li>
