@echo off
echo ========================================
echo Laravel Asset Management
echo Render.com Deployment Preparation
echo ========================================
echo.

echo [1/5] Checking Git installation...
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Git is not installed. Please install Git first.
    pause
    exit /b 1
)
echo Git found!
echo.

echo [2/5] Initializing Git repository...
if not exist .git (
    git init
    echo Git initialized!
) else (
    echo Git already initialized!
)
echo.

echo [3/5] Adding files to Git...
git add .
echo Files added!
echo.

echo [4/5] Creating commit...
git commit -m "Prepare Laravel Asset Management for Render deployment"
echo Commit created!
echo.

echo [5/5] Deployment files ready!
echo.
echo ========================================
echo Next Steps:
echo ========================================
echo.
echo 1. Create a GitHub repository
echo 2. Run these commands:
echo.
echo    git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPO.git
echo    git branch -M main
echo    git push -u origin main
echo.
echo 3. Follow the steps in RENDER-DEPLOYMENT-GUIDE.md
echo.
echo ========================================
echo.
pause
