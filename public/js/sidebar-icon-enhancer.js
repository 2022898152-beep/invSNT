/**
 * Additional sidebar icon enhancements
 */
document.addEventListener('DOMContentLoaded', function() {
    // Make the brand logo in sidebar more visible
    const sidebarBrandLinks = document.querySelectorAll('.filament-sidebar-header a.inline-block svg');
    
    sidebarBrandLinks.forEach(logo => {
        // Check if it's an SVG logo and adjust its styles
        if (logo) {
            logo.style.filter = 'brightness(1.5) drop-shadow(0 0 2px rgba(255, 255, 255, 0.3))';
        }
    });
    
    // Enhance icons in the sidebar with SVG filters
    const sidebarIcons = document.querySelectorAll('.filament-sidebar-nav-item-icon');
    sidebarIcons.forEach(icon => {
        // Ensure the icons are properly visible
        icon.style.stroke = 'white';
        icon.style.strokeWidth = '2';
        
        // Add class for special styling
        icon.classList.add('sidebar-icon-enhanced');
    });
});