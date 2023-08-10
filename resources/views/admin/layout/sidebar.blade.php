<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">
      <img src=" {{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(!empty(Auth::guard('admin')->user()->image))
        <img src="{{ asset('admin/img/photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        @else
          <img src="{{ asset('admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(Session::get('page')=='dashboard')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
          <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Session::get('page')=='updatepassword'||Session::get('page')=='updatedetails')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
          <li class="nav-item menu-open">
           <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page')=='updatepassword')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/update-password')}}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin password</p>
                </a>
              </li>
            @if(Session::get('page')=='updatedetails')
                 @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/update-details')}}" class="nav-link {{ $active }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>              
            </ul>
            </li>
            @if(Session::get('page')=='subadmins')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
            <li class="nav-item">
            <a href="{{ url('admin/sub-admins')}}" class="nav-link {{ $active }} ">
              <i class="nav-icon fas fa-users"></i>              
              <p>
                SubAdmins
              </p>
            </a>
            </li>
            @if(Session::get('page')=='members')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
            <li class="nav-item">
            <a href="{{ url('admin/members')}}" class="nav-link {{ $active }} ">
              <i class="nav-icon fas fa-users"></i>              
              <p>
                Membership
              </p>
            </a>
            </li>

          @if(Session::get('page')=='loans'||Session::get('page')=='loanrepayments'||Session::get('page')=='loanrates'||Session::get('page')=='loantypes')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
            <li class="nav-item menu-open">
           <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Loans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Session::get('page')=='loans')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/loans')}}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Loans</p>
                </a>
              </li>
               @if(Session::get('page')=='loanrepayments')
                 @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/loan_repayments')}}" class="nav-link {{ $active }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Repayments</p>
                </a>
              </li>
              @if(Session::get('page')=='loanrates')
                 @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/loan_rates')}}" class="nav-link {{ $active }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Rates</p>
                </a>
              </li>
              @if(Session::get('page')=='loantypes')
                 @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{ url('admin/loan_types')}}" class="nav-link {{ $active }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Types</p>
                </a>
              </li>             
            </ul>
          </li>





            @if(Session::get('page')=='cmspages')
                  @php $active="active" @endphp
               @else
                  @php $active="" @endphp
               @endif
            <li class="nav-item">
            <a href="{{ url('admin/cms-pages')}}" class="nav-link {{ $active }} ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cms pages               
              </p>
            </a>
            </li>
                 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>