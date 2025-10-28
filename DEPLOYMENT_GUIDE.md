# GitHub Pages Deployment Guide for EEquiz

This guide will walk you through deploying your EEquiz static site to GitHub Pages step by step.

## Prerequisites

- A GitHub account
- Git installed on your computer (optional for command-line method)

## Method 1: GitHub Web Interface (Easiest)

### Step 1: Create a GitHub Repository

1. Go to [GitHub](https://github.com) and log in
2. Click the "+" button in the top right corner
3. Select "New repository"
4. Name your repository (e.g., `eequiz` or `elth-test-circuite`)
5. Choose "Public" (required for free GitHub Pages)
6. Click "Create repository"

### Step 2: Upload Files

1. On your repository page, click "uploading an existing file"
2. Drag and drop ALL files from the `gh-pages` folder
   - Or use "choose your files" to select them
3. Make sure to include:
   - All HTML files (index.html, testecircuite.html, etc.)
   - All folders (css/, js/, data/, testsvg/, img/, vendor/)
   - .nojekyll file (important!)
4. Add a commit message like "Initial commit"
5. Click "Commit changes"

### Step 3: Enable GitHub Pages

1. Go to your repository's "Settings" tab
2. Scroll down and click "Pages" in the left sidebar
3. Under "Source":
   - Select branch: `main`
   - Select folder: `/ (root)`
4. Click "Save"
5. Wait a few minutes for deployment
6. Your site will be available at: `https://yourusername.github.io/repository-name/`

## Method 2: Git Command Line

### Step 1: Initialize and Push

```bash
# Navigate to the gh-pages directory
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"

# Initialize git repository
git init

# Add all files
git add .

# Create initial commit
git commit -m "Initial commit - EEquiz static site"

# Add your GitHub repository as remote (replace with your URL)
git remote add origin https://github.com/yourusername/your-repo-name.git

# Push to GitHub
git branch -M main
git push -u origin main
```

### Step 2: Enable GitHub Pages

Follow Step 3 from Method 1 above.

## Method 3: Using gh-pages Branch (Alternative)

If you want to keep your source files in `main` and deployment files in `gh-pages`:

```bash
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"

# Initialize if needed
git init

# Create and switch to gh-pages branch
git checkout -b gh-pages

# Add all files
git add .

# Commit
git commit -m "Deploy to GitHub Pages"

# Add remote and push
git remote add origin https://github.com/yourusername/your-repo-name.git
git push -u origin gh-pages
```

Then in GitHub Settings → Pages, select the `gh-pages` branch.

## Verification

After deployment:

1. Visit your GitHub Pages URL
2. Test the following:
   - Home page loads correctly
   - Click "Teste circuite" - should generate random circuit problems
   - Fill in some answers and submit - should show results
   - Click "Teste grafuri" - should work similarly
3. Check browser console (F12) for any errors

## Common Issues and Solutions

### Issue: 404 Page Not Found

**Solution:** 
- Make sure `index.html` is in the root directory
- Check that GitHub Pages is enabled in Settings
- Wait 5-10 minutes after enabling (deployment takes time)

### Issue: CSS/JavaScript Not Loading

**Solution:**
- Ensure `.nojekyll` file is present
- Check that all folders (css/, js/, vendor/) were uploaded
- Check browser console for 404 errors on specific files

### Issue: SVG Images Not Displaying

**Solution:**
- Verify `testsvg/` folder was uploaded with all SVG files
- Check file names match (test1-1.svg, test2-1.svg, etc.)

### Issue: Tests Not Generating

**Solution:**
- Open browser console (F12) to check for JavaScript errors
- Ensure `data/testdata.js` was uploaded
- Verify `js/utils.js` is present

### Issue: Relative Path Problems

**Solution:**
If your repository name is `my-repo`, your URL will be:
`https://yourusername.github.io/my-repo/`

You may need to update links if you have path issues. All current paths are relative, so this should work automatically.

## Updating Your Site

To update your site after changes:

### Via Web Interface:
1. Go to your repository on GitHub
2. Navigate to the file you want to change
3. Click the pencil icon to edit
4. Make changes and commit

### Via Git Command Line:
```bash
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"

# Make your changes to files...

# Add changes
git add .

# Commit
git commit -m "Update description"

# Push
git push
```

Changes will appear on your site within a few minutes.

## Custom Domain (Optional)

If you want to use a custom domain:

1. Buy a domain from a registrar (Namecheap, GoDaddy, etc.)
2. In GitHub Settings → Pages → Custom domain, enter your domain
3. In your domain registrar's DNS settings, add:
   - Type: `A` Record
   - Host: `@`
   - Points to: `185.199.108.153` (and the other 3 GitHub IPs)
4. Or use a CNAME record pointing to `yourusername.github.io`

## Testing Locally

To test locally before deployment:

1. Install a local web server:
   ```bash
   # Using Python
   python -m http.server 8000
   
   # Or using Node.js
   npx http-server
   ```

2. Open browser to `http://localhost:8000`
3. Test all functionality

## Security Notes

- All test answers are calculated in the browser
- No sensitive data is transmitted
- All processing is client-side
- No backend server required

## Support

If you encounter issues:
1. Check browser console for errors (F12 → Console)
2. Verify all files were uploaded correctly
3. Check GitHub Actions tab for deployment status
4. Review GitHub Pages documentation: https://docs.github.com/en/pages

---

**Congratulations!** Your EEquiz application should now be live on GitHub Pages! 🎉
