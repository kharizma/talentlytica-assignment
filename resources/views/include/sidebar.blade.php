<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home.index') }}">TALENTLYTICA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home.index') }}">TICA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ (request()->is('home*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-tv"></i> <span>Dashboard</span></a></li>
            <li class="{{ (request()->is('users*')) ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-users"></i> <span>Peserta</span></a></li>
            
            <div class="mt-3 mb-4 p-3 hide-sidebar-mini d-grid">
                <div class="d-grid">
                    <a href="{{ route('auth.logout') }}" class="btn btn-primary btn-icon-split fw-bold btn-lg"><i class="fas fa-sign-out-alt ms-1 me-2"></i> Keluar</a>
                </div>
            </div>
        </ul>
    </aside>
</div>