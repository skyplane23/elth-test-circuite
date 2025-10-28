# EEquiz - Static Version for GitHub Pages

This is a converted static version of the EEquiz electrical engineering quiz application, designed to be hosted on GitHub Pages.

## About

EEquiz is an educational application for practicing electrical engineering knowledge, specifically:
- Circuit analysis problems (Teste Circuite)
- Graph theory problems (Teste Grafuri)

The application generates random problems with variable values and validates student answers.

## Conversion Details

This version has been converted from PHP to a fully static site:
- ✅ All server-side PHP logic converted to client-side JavaScript
- ✅ Test data bundled into JavaScript files
- ✅ Answer validation done in the browser
- ✅ All features working without a backend server

## Features

- Random problem generation
- Dynamic SVG circuit diagrams with substituted values
- Mathematical formula evaluation
- Real-time answer validation
- Score tracking and results display

## Deployment to GitHub Pages

### Option 1: Deploy via GitHub Web Interface

1. Create a new repository on GitHub (or use existing one)
2. Upload the entire contents of the `gh-pages` folder to your repository
3. Go to Settings → Pages
4. Under "Source", select the branch (usually `main`) and folder (root `/`)
5. Click "Save"
6. Your site will be live at `https://yourusername.github.io/repository-name/`

### Option 2: Deploy via Git Command Line

```bash
# Navigate to the gh-pages directory
cd gh-pages

# Initialize git (if not already done)
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit - EEquiz static site"

# Add your GitHub repository as remote
git remote add origin https://github.com/yourusername/your-repo-name.git

# Push to GitHub
git branch -M main
git push -u origin main
```

Then enable GitHub Pages in repository settings as described in Option 1.

### Option 3: Use gh-pages branch

```bash
cd gh-pages

# Create and checkout gh-pages branch
git checkout -b gh-pages

# Add and commit
git add .
git commit -m "Deploy to GitHub Pages"

# Push to gh-pages branch
git push origin gh-pages
```

Then in GitHub Settings → Pages, select the `gh-pages` branch.

## File Structure

```
gh-pages/
├── index.html              # Home page
├── testecircuite.html      # Circuit tests page
├── testegrafuri.html       # Graph tests page
├── raspunsuri.html         # Results page
├── css/                    # Stylesheets
├── js/
│   ├── utils.js           # Utility functions
│   └── resume.min.js      # UI scripts
├── data/
│   └── testdata.js        # Test problem data
├── testsvg/               # SVG circuit diagrams
├── img/                   # Images
└── vendor/                # Third-party libraries
```

## Configuration

You can customize the default test parameters by editing the links in the navigation:

- **Range**: `range=1,10` (min and max values for random variables)
- **Number of exercises**: `nr_ex=10` (number of problems to generate)

Example: `testecircuite.html?range=1,20&nr_ex=15`

## Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- JavaScript must be enabled
- Supports SVG rendering

## Credits

**Realizatori:**
- Liviu-Nicolae Moraru
- Andreea-Diana Oltean
- Stefan Vodita

**Profesor coordonator:** Gabriela Ciuprina

**Original Project:** SCSS-ELTH MAI 2018

**Conversion:** PHP to Static Site for GitHub Pages (2025)

## License

See LICENSE file in the parent directory.
