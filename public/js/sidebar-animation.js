// Add smooth transition for content when sidebar expands/collapses
document.addEventListener('DOMContentLoaded', function() {
    // Find the sidebar toggle button
    const sidebarCollapseButtons = document.querySelectorAll('.filament-sidebar-collapse-button');
    
    sidebarCollapseButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add a small delay to match the sidebar transition
            setTimeout(function() {
                // Force a reflow of the main content to smoothly adjust to the sidebar width change
                const mainContent = document.querySelector('.filament-main');
                if (mainContent) {
                    mainContent.style.transition = 'margin-left 0.3s ease-in-out';
                }
            }, 50);
        });
    });
});