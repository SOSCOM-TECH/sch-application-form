<aside class="sidebar-left border-right bg-white shadow-none border" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>

    <nav class="vertnav navbar navbar-light">

        <!-- Logo -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/soscom.png') }}" class="navbar-brand-img" alt="Logo"
                    style="height: 30px">
            </a>
        </div>

<!-- Dashboard -->
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

        @php($regReq = auth()->user()->schoolRegistrationRequest)

        <li class="nav-item">
            <a href="{{ $regReq ? route('rep.requests.show', $regReq) : route('rep.requests.create') }}" class="nav-link">
                <i class="fe fe-clipboard fe-16"></i>
                <span class="ml-3 item-text">School Registration</span>
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
            <a href="{{ route('admin.requests.index') }}" class="nav-link">
                <i class="fe fe-clipboard fe-16"></i>
                <span class="ml-3 item-text">School Requests</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.payments.index') }}" class="nav-link">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Payments</span>
            </a>
        </li>
    </ul>

    <p class="text-muted nav-heading mt-4 mb-1"><span>Compliance</span></p>

    <ul class="navbar-nav flex-fill w-100">
        <li class="nav-item">
            <a href="{{ route('admin.compliance.audits') }}" class="nav-link">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">Verification Audits</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.compliance.fraud') }}" class="nav-link">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Fraud Logs</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}" class="nav-link">
                <i class="fe fe-key fe-16"></i>
                <span class="ml-3 item-text">Roles & Permissions</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Admin Users</span>
            </a>
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
