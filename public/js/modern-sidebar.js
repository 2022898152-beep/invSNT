/**
 * This script applies the modern-sidebar class to the sidebar element
 */
document.addEventListener('DOMContentLoaded', function() {
    // Add the modern-sidebar class to the sidebar
    const sidebar = document.querySelector('.filament-sidebar');
    if (sidebar) {
        sidebar.classList.add('modern-sidebar');
    }
    
    // Create a visual indicator for active menu items
    const activeItems = document.querySelectorAll('.filament-sidebar-item-active a');
    activeItems.forEach(item => {
        // Add a subtle indicator
        const indicator = document.createElement('span');
        indicator.classList.add('active-indicator');
        indicator.style.position = 'absolute';
        indicator.style.right = '0';
        indicator.style.top = '50%';
        indicator.style.transform = 'translateY(-50%)';
        indicator.style.width = '4px';
        indicator.style.height = '50%';
        indicator.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
        indicator.style.borderRadius = '2px';
        
        // Make the parent position relative if it isn't already
        if (window.getComputedStyle(item).position !== 'relative') {
            item.style.position = 'relative';
        }
        
        item.appendChild(indicator);
    });
});