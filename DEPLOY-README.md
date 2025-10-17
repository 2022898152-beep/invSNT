# 🚀 Quick Start: Deploy to Render

## 1️⃣ One-Click Preparation

Run this command in your project folder:
```bash
prepare-deployment.bat
```

## 2️⃣ Push to GitHub

1. Create a new repository on GitHub
2. Run these commands (replace with your repo URL):
   ```bash
   git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPO.git
   git branch -M main
   git push -u origin main
   ```

## 3️⃣ Deploy on Render

1. Go to https://render.com
2. Click **"New +"** → **"Blueprint"**
3. Connect your GitHub repository
4. Click **"Apply"**
5. Wait for deployment to complete

## 4️⃣ Configure

1. Generate APP_KEY:
   ```bash
   php artisan key:generate --show
   ```
   
2. Add the APP_KEY to Render environment variables

3. Update APP_URL with your Render URL

## ✅ Done!

Your app will be live at: `https://your-app-name.onrender.com`

📖 **Detailed Guide**: See [RENDER-DEPLOYMENT-GUIDE.md](RENDER-DEPLOYMENT-GUIDE.md)

---

## 📋 Files Included for Deployment

- ✅ `Dockerfile` - Docker container configuration
- ✅ `nginx.conf` - Nginx web server configuration  
- ✅ `build.sh` - Build script for Render
- ✅ `start.sh` - Start script for Render
- ✅ `render.yaml` - Render blueprint configuration
- ✅ `.dockerignore` - Files to exclude from Docker
- ✅ `.env.example` - Environment variables template

## 🆘 Need Help?

Check the [RENDER-DEPLOYMENT-GUIDE.md](RENDER-DEPLOYMENT-GUIDE.md) for:
- Step-by-step instructions
- Troubleshooting tips
- Performance optimization
- Custom domain setup
- And more!

---

**Happy Deploying! 🎉**
