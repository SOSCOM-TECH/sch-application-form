<aside class="sidebar-left border-right bg-white shadow-none border" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>

    <nav class="vertnav navbar navbar-light">

        <!-- Logo -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo/logo-dark.svg') }}" class="navbar-brand-img" alt="Logo"
                    >
            </a>
        </div>

<ul class="navbar-nav flex-fill w-100">
    @role('admin')
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span>
            </a>
        </li>
    @endrole

    @role('school_representative')
        <li class="nav-item">
            <a href="{{ route('client.dashboard') }}" class="nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('rep.forms.index') }}" class="nav-link">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">Form Builder</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rep.applicants.index') }}" class="nav-link">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Applicants</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rep.school.show') }}" class="nav-link">
                <i class="fe fe-briefcase fe-16"></i>
                <span class="ml-3 item-text">Your School</span>
            </a>
        </li>
    @endrole
</ul>

@role('admin')
    <p class="text-muted nav-heading mt-4 mb-1"><span>Administration</span></p>

    <ul class="navbar-nav flex-fill w-100">
        <li class="nav-item">
            <a href="{{ route('admin.schools.index') }}" class="nav-link">
                <i class="fe fe-briefcase fe-16"></i>
                <span class="ml-3 item-text">Schools</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.payments.index') }}" class="nav-link">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Payments</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.packages.index') }}" class="nav-link">
                <i class="fe fe-package fe-16"></i>
                <span class="ml-3 item-text">Packages</span>
            </a>
        </li>

    </ul>

    <p class="text-muted nav-heading mt-4 mb-1"><span>Compliance</span></p>

    <ul class="navbar-nav flex-fill w-100">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="complianceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Compliance</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="complianceDropdown">
                <a href="{{ route('admin.compliance.audits') }}" class="dropdown-item">
                    <i class="fe fe-layers fe-16 mr-2"></i>
                    Verification Audits
                </a>
                <a href="{{ route('admin.compliance.fraud') }}" class="dropdown-item">
                    <i class="fe fe-shield fe-16 mr-2"></i>
                    Fraud Logs
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="adminManagementDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Admin Management</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="adminManagementDropdown">
                <a href="{{ route('admin.roles.index') }}" class="dropdown-item">
                    <i class="fe fe-key fe-16 mr-2"></i>
                    Roles & Permissions
                </a>
                <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                    <i class="fe fe-users fe-16 mr-2"></i>
                    Admin Users
                </a>
            </div>
        </li>
    </ul>
@endrole


        <div class="btn-box w-100 mt-5 mb-3 px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-block">
                    <i class="fe fe-log-out fe-12 mx-2"></i>
                    <span class="small">Log out</span>
                </button>
            </form>
        </div>

    </nav>
</aside>
