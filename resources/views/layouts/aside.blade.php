<div class="quixnav bg-primary">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">


            <li class="nav-label first">Main Menu</li>
@role('admin')
            <li><a href="{{ route('dashboard') }}"><i class="ti ti-home"></i><span
                        class="nav-text">Dashboard</span></a>
            </li>
            @endrole
            @role('school_representative')
            <li>
                <a href="{{ route('client.dashboard') }}"><i class="ti ti-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @php($regReq = auth()->user()->schoolRegistrationRequest)
            <li>
                <a href="{{ $regReq ? route('rep.requests.show', $regReq) : route('rep.requests.create') }}"><i class="ti ti-clipboard"></i>
                    <span class="nav-text">School Registration</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rep.forms.index') }}"><i class="ti ti-agenda"></i>
                    <span class="nav-text">Form Builder</span>
                </a>
            </li>
            @endrole

            @role('admin')
            <li class="nav-label">Administration</li>
            <li>
                <a href="{{ route('admin.requests.index') }}"><i class="ti ti-clipboard"></i>
                    <span class="nav-text">School Requests</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.roles.index') }}"><i class="ti ti-key"></i>
                    <span class="nav-text">Roles & Permissions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"><i class="ti ti-user"></i>
                    <span class="nav-text">Admin Users</span>
                </a>
            </li>
            @endrole


        </ul>
    </div>
</div>
