<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8; width:40px; border-radius: 50%;">
            HACKDAY'S IA
        </div>
    </div>

    <div class="nav-menu">
        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href={{ url('admin/dashboard') }} class="nav-item  {{ request()->is('admin/dashboard') ? 'active' : '' }}" data-page="dashboard">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                Tableau de bord
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Hackthon</div>
            <a href={{ url('admin/candidats') }} class="nav-item {{ request()->is('admin/candidats') ? 'active' : '' }}" data-page="users">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                Candidats
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Configuration</div>
            <a href={{ url('admin/users') }} class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}" data-page="settings">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd" />
                </svg>
                Paramètres
            </a>
        </div>
    </div>
</nav>
