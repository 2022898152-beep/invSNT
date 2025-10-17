# 🚀 Deploy Laravel Asset Management to Render.com

## Complete Deployment Guide

This guide will help you deploy your Laravel Asset Management application to Render.com.

---

## 📋 Prerequisites

1. ✅ **GitHub Account** - Your code must be in a GitHub repository
2. ✅ **Render.com Account** - Sign up at https://render.com (free tier available)
3. ✅ **Application Key** - Laravel requires an APP_KEY

---

## 🎯 Step-by-Step Deployment

### Step 1: Prepare Your Repository

1. **Push your code to GitHub**:
   ```bash
   git init
   git add .
   git commit -m "Prepare for Render deployment"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPO.git
   git push -u origin main
   ```

2. **Make sure these files are in your repository**:
   - ✅ `Dockerfile`
   - ✅ `nginx.conf`
   - ✅ `build.sh`
   - ✅ `start.sh`
   - ✅ `render.yaml`
   - ✅ `.env.example`

### Step 2: Sign Up / Login to Render

1. Go to https://render.com
2. Sign up or login with your GitHub account
3. Authorize Render to access your repositories

### Step 3: Create a MySQL Database

1. From your Render Dashboard, click **"New +"** → **"PostgreSQL"** or **"MySQL"**
   
   **For MySQL (Recommended for Laravel)**:
   - External MySQL providers: PlanetScale, Railway, or Render's PostgreSQL (you can adapt)
   
   **OR use PostgreSQL** (Render native):
   - Name: `laravel-asset-db`
   - Database: `asset_management`
   - User: `asset_user`
   - Region: Choose closest to your users
   - Plan: **Free** (for testing) or **Starter** ($7/month)

2. **Click "Create Database"**

3. **Copy the database credentials** - you'll need:
   - Internal Database URL
   - External Database URL
   - Host
   - Port
   - Database name
   - Username
   - Password

### Step 4: Deploy Web Service Using Blueprint

**Option A: Using render.yaml (Recommended)**

1. Click **"New +"** → **"Blueprint"**
2. Connect your GitHub repository
3. Render will detect `render.yaml` and show the services
4. Review the configuration
5. Click **"Apply"**

**Option B: Manual Setup**

1. Click **"New +"** → **"Web Service"**
2. Connect your GitHub repository
3. Configure:
   - **Name**: `laravel-asset-management`
   - **Environment**: `Docker`
   - **Region**: Choose closest to your users
   - **Branch**: `main`
   - **Dockerfile Path**: `./Dockerfile`
   - **Docker Command**: Leave empty (uses Dockerfile CMD)

### Step 5: Configure Environment Variables

Add these environment variables in Render dashboard:

```env
APP_NAME=Laravel Asset Management
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_URL=https://your-app-name.onrender.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=your-database-host.render.com
DB_PORT=3306
DB_DATABASE=asset_management
DB_USERNAME=asset_user
DB_PASSWORD=your-database-password

CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
SESSION_LIFETIME=1440

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

**IMPORTANT**: Generate APP_KEY:
- Locally run: `php artisan key:generate --show`
- Copy the output (including `base64:`)
- Paste it as the APP_KEY value

### Step 6: Deploy!

1. Click **"Create Web Service"** (or "Apply" for blueprint)
2. Render will:
   - Pull your code from GitHub
   - Build the Docker image
   - Run migrations
   - Start the application

3. **Monitor the build logs** to ensure everything deploys successfully

4. Once deployed, you'll get a URL like:
   ```
   https://your-app-name.onrender.com
   ```

---

## 🔧 Post-Deployment Configuration

### 1. Update APP_URL

Update the `APP_URL` environment variable with your actual Render URL:
```
APP_URL=https://your-actual-app-name.onrender.com
```

### 2. Run Migrations (if not automatic)

From Render Dashboard → Shell:
```bash
php artisan migrate --force
```

### 3. Create Admin User

From Render Dashboard → Shell:
```bash
php artisan tinker
```

Then run:
```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'admin@example.com';
$user->password = bcrypt('your-secure-password');
$user->email_verified_at = now();
$user->save();

// Assign super_admin role
$user->assignRole('super_admin');
```

### 4. Seed Initial Data (Optional)

```bash
php artisan db:seed --force
```

---

## 🎨 Custom Domain (Optional)

1. Go to your web service settings
2. Click **"Custom Domains"**
3. Add your domain (e.g., `assets.yourdomain.com`)
4. Update DNS records as instructed by Render
5. Render provides free SSL certificates automatically!

---

## 📊 Performance Optimization on Render

### Enable Persistent Disk (for storage)

1. Go to your web service
2. Click **"Disks"** tab
3. Add a disk:
   - **Mount Path**: `/var/www/html/storage`
   - **Size**: 1GB (free tier) or more

### Scaling

- **Free Plan**: Spins down after 15 minutes of inactivity
- **Starter Plan** ($7/month): Always on, 512 MB RAM
- **Standard Plan** ($25/month): 2 GB RAM, better performance

---

## 🔍 Monitoring & Debugging

### View Logs

1. Go to your web service dashboard
2. Click **"Logs"** tab
3. View real-time application logs

### Access Shell

1. Go to your web service dashboard
2. Click **"Shell"** tab
3. Run Laravel commands directly

### Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate --force

# Check application status
php artisan about

# View routes
php artisan route:list

# Create user
php artisan tinker
```

---

## ⚠️ Important Notes

### Security

1. ✅ **Never commit `.env` file** to Git
2. ✅ **Use strong APP_KEY** (auto-generated)
3. ✅ **Set APP_DEBUG=false** in production
4. ✅ **Use environment variables** for sensitive data

### Database

1. 📊 **Backup regularly** - Render provides automated backups on paid plans
2. 🔄 **Use migrations** - Never manually modify production database
3. 💾 **Consider external database** - PlanetScale (free tier) or Railway for MySQL

### Performance

1. ⚡ **Enable caching** - Already configured (database driver)
2. 🚀 **Use CDN** - For static assets (optional)
3. 📦 **Optimize images** - Compress before uploading

---

## 🆘 Troubleshooting

### Issue: "500 Internal Server Error"

**Solution**:
1. Check logs in Render dashboard
2. Ensure APP_KEY is set correctly
3. Verify database credentials
4. Run: `php artisan optimize:clear`

### Issue: "Database Connection Failed"

**Solution**:
1. Verify DB_HOST, DB_PORT, DB_DATABASE
2. Check database is running in Render
3. Ensure database allows connections from web service

### Issue: "Assets Not Loading"

**Solution**:
1. Run `npm run build` before deployment
2. Check `public/build` directory exists
3. Verify `APP_URL` is correct

### Issue: "Migrations Failed"

**Solution**:
1. Check database credentials
2. Manually run: `php artisan migrate --force`
3. Check migration files for errors

### Issue: "Session Not Persisting"

**Solution**:
1. Ensure `sessions` table exists
2. Run: `php artisan migrate`
3. Verify SESSION_DRIVER=database

---

## 📚 Additional Resources

- **Render Docs**: https://render.com/docs
- **Laravel Deployment**: https://laravel.com/docs/deployment
- **Render Community**: https://community.render.com

---

## ✅ Deployment Checklist

Before going live:

- [ ] Code pushed to GitHub
- [ ] Database created and configured
- [ ] All environment variables set
- [ ] APP_KEY generated
- [ ] APP_DEBUG=false
- [ ] Migrations run successfully
- [ ] Admin user created
- [ ] Test login functionality
- [ ] Test asset creation/management
- [ ] Verify email sending (if configured)
- [ ] Custom domain configured (optional)
- [ ] SSL certificate active
- [ ] Backup strategy in place

---

## 🎉 Success!

Your Laravel Asset Management application is now live on Render!

**Next Steps**:
1. Test all functionality
2. Invite team members
3. Set up monitoring
4. Configure backups
5. Consider upgrading to paid plan for better performance

---

## 💰 Cost Estimate

### Free Tier
- Web Service: Free (spins down after 15 min inactivity)
- PostgreSQL: Free (limited storage)
- **Total: $0/month**

### Recommended Production Setup
- Web Service (Starter): $7/month
- PostgreSQL (Starter): $7/month
- **Total: $14/month**

### Enterprise Setup
- Web Service (Standard): $25/month
- PostgreSQL (Standard): $20/month
- **Total: $45/month**

---

**Deployment Date**: October 17, 2025  
**Status**: Ready for Deployment 🚀  
**Estimated Setup Time**: 15-30 minutes

Good luck with your deployment! 🎊
