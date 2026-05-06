 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item nav-profile">
             <a href="{{ route('dashboard') }}" class="nav-link">

                 <div class="nav-profile-image">
                     @if (Auth::user()->image)
                         <img src="{{ asset('admin/asset/profilephoto/' . Auth::user()->image) }}" alt="profile" />
                     @else
                         <img src="{{ asset('admin/asset/dummy/dummy.jpg') }}" alt="profile" />
                     @endif

                     <span class="login-status online"></span>
                 </div>

                 <div class="nav-profile-text d-flex flex-column">
                     <span class="font-weight-bold mb-2">
                         {{ Auth::user()->name }}
                     </span>

                     <span class="text-secondary text-small">
                         {{ Auth::user()->role }}
                     </span>
                 </div>

                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('dashboard') }}">
                 <span class="menu-title">Dashboard</span>
                 <i class="mdi mdi-home menu-icon text-primary"></i>
             </a>
         </li>


         @if (Auth::user()->role === 'admin')
             @include('layouts.admin.components.adminSidebar')
         @endif

         @if (Auth::user()->role === 'donor')
             @include('layouts.admin.components.donorSidebar')
         @endif

         @if (Auth::user()->role === 'beneficiary')
             @include('layouts.admin.components.beneficiarySidebar')
         @endif


     </ul>
 </nav>
