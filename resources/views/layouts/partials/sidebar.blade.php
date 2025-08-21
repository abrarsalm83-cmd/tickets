<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo"></div>
        <div class="sidebar-title">Tickets</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <div class="nav-icon">🏠</div>
            <div class="nav-text">Dashboard</div>
        </a>

        <a href="{{ route('category-types.index') }}"
            class="nav-item {{ request()->routeIs('category-types.*') ? 'active' : '' }}">
            <div class="nav-icon">🔖</div>
            <div class="nav-text">Category Types</div>
        </a>

        <a href="{{ route('categories.index') }}"
            class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <div class="nav-icon">📁</div>
            <div class="nav-text">Categories</div>
        </a>

        <a href="{{ route('clients.index') }}"
            class="nav-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
            <div class="nav-icon">👥</div>
            <div class="nav-text">Clients</div>
        </a>

        <a href="{{ route('tickets.index') }}" class="nav-item {{ request()->routeIs('tickets.*') ? 'active' : '' }}">
            <div class="nav-icon">🎫</div>
            <div class="nav-text">Tickets</div>
        </a>

        <a href="{{ route('settings.index') }}"
            class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <div class="nav-icon">⚙️</div>
            <div class="nav-text">Settings</div>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <div class="nav-icon">🚪</div>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleDropdown(button) {
        const menu = button.nextElementSibling;
        const isOpen = menu.classList.contains('show');

        // Close all other dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
        document.querySelectorAll('.dropdown-toggle').forEach(t => t.classList.remove('active'));

        // Toggle current dropdown
        if (!isOpen) {
            menu.classList.add('show');
            button.classList.add('active');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.dropdown-toggle').forEach(t => t.classList.remove('active'));
        }
    });
</script>
