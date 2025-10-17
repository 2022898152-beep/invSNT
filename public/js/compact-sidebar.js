// Compact Sidebar Script
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.filament-sidebar');
    if (sidebar) {
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) sidebar.classList.add('collapsed');
    }
});
