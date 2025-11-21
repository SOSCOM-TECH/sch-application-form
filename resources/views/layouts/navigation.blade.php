<nav class="navbar navbar-light bg-white border mb-4">

    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav ms-auto align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link text-muted" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fe fe-layers"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg border-0 rounded-3" style="min-width: 250px;">
                <div class="mb-2">
                    <h6 class="fw-bold mb-0">Quick Actions</h6>
                    <small class="text-muted">Shortcuts</small>
                </div>

                <div class="row g-2">



                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link text-muted d-flex align-items-center" href="{{ route('profile.edit') }}">
                <span class="avatar avatar-sm m-1"
                    style="width: 32px; height: 32px; overflow: hidden; display: inline-block;">
                    <img src="{{ asset(Auth::user()->file ?? 'images/profile.jpg') }}" alt="..."
                        class="avatar-img rounded-circle"
                        style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                </span>
                <span class="fw-bold">{{ Auth::user()->name }}</span>
            </a>
        </li>
    </ul>
</nav>
