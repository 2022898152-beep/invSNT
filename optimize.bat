@echo off
echo ---------------------------------------------
echo Laravel Asset Management Optimization Script
echo ---------------------------------------------
echo.

echo Clearing application cache...
php artisan cache:clear
echo.

echo Clearing configuration cache...
php artisan config:clear
echo.

echo Clearing route cache...
php artisan route:clear
echo.

echo Clearing view cache...
php artisan view:clear
echo.

echo Optimizing configuration loading...
php artisan config:cache
echo.

echo Optimizing route loading...
php artisan route:cache
echo.

echo Optimizing class loading...
php artisan optimize
echo.

echo ---------------------------------------------
echo Optimization complete! Your application should now run faster.
echo ---------------------------------------------
echo.
echo If you're still experiencing slow load times, you may want to:
echo 1. Check your database queries (use php artisan debug:query if installed)
echo 2. Consider updating your database indexes
echo 3. Check for slow middleware operations
echo.
pause