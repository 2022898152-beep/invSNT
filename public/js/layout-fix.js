// Sidebar layout fix
document.addEventListener('DOMContentLoaded', function() {
    // Get the sidebar element and main content area
    const sidebar = document.querySelector('.filament-sidebar');
    const mainContent = document.querySelector('.filament-main');
    
    // Function to handle layout changes when sidebar state changes
    function updateLayout() {
        if (sidebar.classList.contains('filament-sidebar-open')) {
            mainContent.style.marginLeft = '280px';
            mainContent.style.width = 'calc(100% - 280px)';
        } else {
            mainContent.style.marginLeft = '90px';
            mainContent.style.width = 'calc(100% - 90px)';
        }
    }
    
    // Initial layout setup
    updateLayout();
    
    // Create a MutationObserver to watch for changes to the sidebar's classes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                updateLayout();
            }
        });
    });
    
    // Start observing the sidebar element
    observer.observe(sidebar, { attributes: true });
    
    // Handle responsive layout for mobile
    function handleResponsiveLayout() {
        if (window.innerWidth < 1024) {
            mainContent.style.marginLeft = '0';
            mainContent.style.width = '100%';
        } else {
            updateLayout();
        }
    }
    
    // Listen for window resize events
    window.addEventListener('resize', handleResponsiveLayout);
    
    // Initial responsive layout setup
    handleResponsiveLayout();
});