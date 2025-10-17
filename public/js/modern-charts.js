// This file contains custom JavaScript to enhance charts in the dashboard
// Created: October 1, 2023

document.addEventListener('DOMContentLoaded', function() {
    // Override Chart.js defaults to make charts look more modern
    if (window.Chart) {
        Chart.defaults.font.family = "'Inter', 'Helvetica', 'Arial', sans-serif";
        Chart.defaults.color = '#64748b'; // text color
        Chart.defaults.borderColor = '#e2e8f0'; // grid lines
        Chart.defaults.elements.line.tension = 0.4; // smoother lines
        Chart.defaults.elements.line.borderWidth = 3;
        Chart.defaults.elements.point.radius = 3;
        Chart.defaults.elements.point.hoverRadius = 5;
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.cornerRadius = 6;
        Chart.defaults.plugins.tooltip.titleFont.weight = 'bold';
        
        // Add shadow to datasets
        const originalLineController = Chart.registry.getController('line');
        Chart.defaults.elements.line.borderJoinStyle = 'round';
        
        // Add event listeners to enhance charts on hover
        document.querySelectorAll('.filament-widget.filament-widgets-chart-widget').forEach(function(chartWidget) {
            chartWidget.addEventListener('mouseenter', function() {
                this.classList.add('chart-hover');
            });
            
            chartWidget.addEventListener('mouseleave', function() {
                this.classList.remove('chart-hover');
            });
        });
    }

    // Add animation to stats cards
    document.querySelectorAll('.filament-stats-overview-widget-card').forEach(function(card, index) {
        card.style.animationDelay = (index * 0.1) + 's';
        card.classList.add('animate-fade-in');
    });
});