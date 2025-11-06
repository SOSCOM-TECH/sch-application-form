<div class="quixnav bg-primary">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">


            <li class="nav-label first">Main Menu</li>

            <li><a href="{{ route('dashboard') }}"><i class="icon icon-app-store"></i><span
                        class="nav-text">Dashboard</span></a>
            </li>

            @role('admin')
            <li class="nav-label">Administration</li>
            <li>
                <a href="{{ route('admin.roles.index') }}"><i class="icon icon-key"></i>
                    <span class="nav-text">Roles & Permissions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"><i class="icon icon-people"></i>
                    <span class="nav-text">Admin Users</span>
                </a>
            </li>
            @endrole


        </ul>
    </div>
</div>
