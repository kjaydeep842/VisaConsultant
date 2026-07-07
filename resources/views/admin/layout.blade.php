<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NV Visa Consultancy – Admin Panel">
    <title>@yield('title', 'Dashboard') | NV Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    @stack('styles')
</head>
<body class="admin-body">

<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <div class="logo-icon"><i class="fas fa-globe-americas"></i></div>
            <div class="logo-text">
                <span class="logo-nv">NV</span><span class="logo-visa">Visa</span>
                <small>Admin Panel</small>
            </div>
        </a>
        <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
        <div class="user-info">
            <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
            <span>{{ ucfirst(auth()->user()->role ?? 'admin') }}</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.leads.index') }}" class="sidebar-link {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
            <i class="fas fa-user-tag"></i><span>Lead Pipeline</span>
            {{-- @if($newLeadsCount ?? 0) <span class="badge-count">{{ $newLeadsCount }}</span> @endif --}}
        </a>
        <a href="{{ route('admin.applications.index') }}" class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fas fa-folder-open"></i><span>Applications</span>
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="sidebar-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i><span>Appointments</span>
        </a>

        <div class="nav-section-label">Content</div>
        <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i><span>Blogs & Articles</span>
        </a>
        <a href="{{ route('admin.countries.index') }}" class="sidebar-link {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
            <i class="fas fa-globe-americas"></i><span>Countries</span>
        </a>
        <a href="{{ route('admin.visa-categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.visa-categories.*') ? 'active' : '' }}">
            <i class="fas fa-id-card"></i><span>Visa Categories</span>
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="fas fa-star"></i><span>Testimonials</span>
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
            <i class="fas fa-question-circle"></i><span>FAQs</span>
        </a>
        <a href="{{ route('admin.team.index') }}" class="sidebar-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i><span>Team</span>
        </a>
        <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <i class="fas fa-bullhorn"></i><span>News</span>
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
            <i class="fas fa-images"></i><span>Gallery Manager</span>
        </a>

        <div class="nav-section-label">System</div>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i><span>User Management</span>
        </a>
        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="fas fa-cogs"></i><span>Settings</span>
        </a>
        <a href="{{ route('admin.analytics') }}" class="sidebar-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i><span>Analytics</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="sidebar-link sidebar-link-muted" target="_blank">
            <i class="fas fa-external-link-alt"></i><span>View Website</span>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link sidebar-link-danger w-full">
                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Main Content Area -->
<div class="admin-main" id="adminMain">
    <!-- Top Header -->
    <header class="admin-topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="page-breadcrumb">
                <span>Admin</span>
                <i class="fas fa-chevron-right"></i>
                <span>@yield('title', 'Dashboard')</span>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-time" id="topbarTime"></div>
            <a href="{{ route('home') }}" class="topbar-btn" target="_blank" title="View Website">
                <i class="fas fa-globe"></i>
            </a>
            <div class="topbar-user">
                <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
                <span class="topbar-username">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <div><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            <button class="alert-dismiss"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div class="admin-alert admin-alert-error">
            <div><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            <button class="alert-dismiss"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if($errors->any())
        <div class="admin-alert admin-alert-error">
            <div>
                <i class="fas fa-exclamation-triangle"></i>
                @foreach($errors->all() as $err) {{ $err }}. @endforeach
            </div>
            <button class="alert-dismiss"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <!-- Page Content -->
    <div class="admin-content">
        @yield('content')
    </div>
</div>

<script>
const menuToggle = document.getElementById('menuToggle');
const adminSidebar = document.getElementById('adminSidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const sidebarClose = document.getElementById('sidebarClose');

function openSidebar() {
    adminSidebar.classList.add('open');
    sidebarOverlay.classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    adminSidebar.classList.remove('open');
    sidebarOverlay.classList.remove('show');
    document.body.style.overflow = '';
}
menuToggle?.addEventListener('click', () => {
    if (adminSidebar.classList.contains('open')) closeSidebar();
    else openSidebar();
});
sidebarClose?.addEventListener('click', closeSidebar);
sidebarOverlay?.addEventListener('click', closeSidebar);

// Alert dismiss
document.querySelectorAll('.alert-dismiss').forEach(btn => {
    btn.addEventListener('click', () => btn.closest('.admin-alert').remove());
});



// Live time
function updateTime() {
    const el = document.getElementById('topbarTime');
    if (el) {
        const now = new Date();
        el.textContent = now.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', hour12: true });
    }
}
updateTime();
setInterval(updateTime, 60000);

// Global Delete Submit Helper (using premium custom modal to prevent browser pop-up blocking)
let deleteTargetUrl = '';

function confirmAndSubmitDelete(url, message) {
    deleteTargetUrl = url;
    const modal = document.getElementById('deleteConfirmModal');
    const msgEl = document.getElementById('deleteModalMessage');
    if (msgEl && message) {
        msgEl.textContent = message;
    } else if (msgEl) {
        msgEl.textContent = 'Are you sure you want to delete this item? This action cannot be undone.';
    }
    
    if (modal) {
        modal.style.display = 'flex';
        // Trigger layout reflow to allow transition
        void modal.offsetWidth;
        modal.classList.add('show');
    }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 200);
    }
    deleteTargetUrl = '';
}

document.addEventListener('DOMContentLoaded', function() {
    const confirmBtn = document.getElementById('deleteModalConfirmBtn');
    confirmBtn?.addEventListener('click', function() {
        if (deleteTargetUrl) {
            const form = document.getElementById('globalDeleteForm');
            form.action = deleteTargetUrl;
            form.submit();
        }
        closeDeleteModal();
    });
    
    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
});
</script>

<!-- Custom Premium Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="delete-modal-overlay" style="display: none;">
    <div class="delete-modal-card">
        <div class="delete-modal-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="delete-modal-title">Confirm Deletion</h3>
        <p class="delete-modal-text" id="deleteModalMessage">Are you sure you want to delete this item? This action cannot be undone.</p>
        <div class="delete-modal-actions">
            <button type="button" class="btn btn-sm btn-outline" style="border: 1px solid var(--admin-border); background: transparent; color: var(--admin-text);" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" id="deleteModalConfirmBtn">Yes, Delete</button>
        </div>
    </div>
</div>

<!-- Global Hidden Delete Form -->
<form id="globalDeleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@stack('scripts')
</body>
</html>
