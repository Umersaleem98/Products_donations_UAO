<li class="nav-item">

    @if(isset($profileCompletion) && $profileCompletion < 85)

        <a class="nav-link nav-link-disabled"
           href="javascript:void(0)"
           style="opacity:0.6; pointer-events:none; display:block;">

            <div style="display:flex; align-items:center; justify-content:space-between;">
                <span class="menu-title">All Products</span>
                <i class="text-primary mdi mdi-cube-outline menu-icon"></i>
            </div>

            <span style="
                display:block;
                font-size:10.5px;
                color:#dc3545;
                margin-left:32px;
                margin-top:2px;
                line-height:1.2;
            ">
                ⚠ Complete profile to 85% to unlock
            </span>

        </a>

    @else

        <a class="nav-link"
           href="{{ route('beneficiary.products.index') }}"
           style="display:flex; align-items:center; justify-content:space-between;">

            <span class="menu-title">All Products</span>
            <i class="text-primary mdi mdi-cube-outline menu-icon"></i>

        </a>

    @endif

</li>

<li class="nav-item">

    @if(isset($profileCompletion) && $profileCompletion < 85)

        <a class="nav-link nav-link-disabled"
           href="javascript:void(0)"
           style="opacity:0.6; pointer-events:none; display:block;">

            <div style="display:flex; align-items:center; justify-content:space-between;">
                <span class="menu-title">My Requests</span>
                <i class="text-primary mdi mdi-clipboard-text menu-icon"></i>
            </div>

            <span style="
                display:block;
                font-size:10.5px;
                color:#dc3545;
                margin-left:32px;
                margin-top:2px;
                line-height:1.2;
            ">
                ⚠ Profile must be 85% complete
            </span>

        </a>

    @else

        <a class="nav-link"
           href="{{ route('beneficiary.my.requests') }}"
           style="display:flex; align-items:center; justify-content:space-between;">

            <span class="menu-title">My Requests</span>
            <i class="text-primary mdi mdi-clipboard-text menu-icon"></i>

        </a>

    @endif

</li>

<li class="nav-item">
    <a class="nav-link"
       href="{{ route('Beneficiary.profile.index') }}"
       style="display:flex; align-items:center; justify-content:space-between;">

        <span class="menu-title">My Profile</span>
        <i class="text-primary mdi mdi-account-circle menu-icon"></i>

    </a>
</li>
