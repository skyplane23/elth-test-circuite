# Testing Guide for EEquiz Static Site

## How to Test Locally

Before deploying to GitHub Pages, you should test the site locally to ensure everything works correctly.

### Method 1: Using Python (Recommended)

If you have Python installed:

```bash
# Navigate to the gh-pages directory
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"

# Python 3
python -m http.server 8000

# Or Python 2
python -m SimpleHTTPServer 8000
```

Then open your browser to: `http://localhost:8000`

### Method 2: Using Node.js

If you have Node.js installed:

```bash
# Install http-server globally (one-time)
npm install -g http-server

# Navigate to the gh-pages directory
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"

# Start server
http-server
```

Then open your browser to: `http://localhost:8080`

### Method 3: Using PHP Built-in Server

```bash
cd "E:\My Projects\PHP\elth-test-circuite\gh-pages"
php -S localhost:8000
```

Then open your browser to: `http://localhost:8000`

### Method 4: Using VS Code Live Server Extension

1. Install "Live Server" extension in VS Code
2. Right-click on `index.html`
3. Select "Open with Live Server"

## Testing Checklist

### 1. Home Page Test
- [ ] Navigate to `http://localhost:8000/index.html`
- [ ] Page loads without errors
- [ ] Navigation menu displays correctly
- [ ] All links are clickable

### 2. Circuit Tests (Teste Circuite)
- [ ] Click "Teste circuite" in navigation
- [ ] Tests generate (you should see circuit diagrams)
- [ ] Open browser console (F12) and check for:
  - "Generating X tests" message
  - Test details for each problem
  - Generated values and calculated answers
- [ ] SVG diagrams display correctly with variable values substituted
- [ ] Input fields appear for each unknown variable
- [ ] Fill in some answers (try correct and incorrect ones)
- [ ] Click "Submit" button
- [ ] Should redirect to results page

### 3. Results Page Test
- [ ] After submitting tests, you should see:
  - Score summary with percentage
  - Detailed results for each problem
  - Your answer vs. correct answer
  - Checkmarks (✓) for correct, crosses (✗) for incorrect
- [ ] Check browser console for debug logs
- [ ] Verify the calculations are correct

### 4. Graph Tests (Teste Grafuri)
- [ ] Navigate back to home
- [ ] Click "Teste grafuri"
- [ ] Repeat steps from Circuit Tests section
- [ ] Verify tests 54-63 are being used

## Debugging Issues

### Issue: Tests Don't Generate

**Check Browser Console (F12 → Console tab):**

1. Look for error messages
2. Check if these logs appear:
   - "Generating X tests"
   - Test details with variables and values
3. Common issues:
   - `CIRCUIT_TESTS is not defined` → testdata.js not loading
   - `generateVariableValues is not a function` → utils.js not loading

**Solution:**
- Verify file paths are correct
- Make sure you're running a local server (not opening file:// directly)
- Check Network tab (F12) for 404 errors

### Issue: SVG Diagrams Don't Appear

**Check:**
1. Browser console for fetch errors
2. Network tab for 404 errors on SVG files
3. Make sure `testsvg/` folder has all files

### Issue: Results Page Shows "No Results"

**Possible causes:**
1. SessionStorage not working (try different browser)
2. Form submission error (check console before redirect)
3. Data not being saved properly

**Debug steps:**
1. Open browser console before submitting test
2. Look for error messages
3. After clicking submit, check if "testResults" exists in sessionStorage:
   ```javascript
   console.log(sessionStorage.getItem('testResults'));
   ```

### Issue: Answers Calculated Incorrectly

**Check browser console for:**
- "Generated values: {...}" - verify values are reasonable
- "Calculated answers: {...}" - verify answers match formulas

**Common problems:**
- Variables with similar names (varI vs varI1) - FIXED in latest version
- Division by zero - should be prevented by code
- Formula evaluation errors

## Manual Formula Testing

To test if formulas are calculating correctly, open browser console and try:

```javascript
// Load the utilities (if not already loaded)
// Then test individual functions:

// Test evalMath
evalMath("(5)*(10)"); // Should return 50
evalMath("((10)-(5))/(2)"); // Should return 2.5

// Test with actual variables
const testVars = { varI: 5, varR: 10 };
evaluateFormulaWithVars("((varR)*(varI))", testVars); // Should return 50
```

## Testing Different Parameters

Test with different URL parameters:

1. **Small range:** `testecircuite.html?range=1,5&nr_ex=3`
   - Values should be between 1 and 5
   
2. **Large range:** `testecircuite.html?range=1,100&nr_ex=5`
   - Values should be between 1 and 100
   
3. **Many tests:** `testecircuite.html?range=1,10&nr_ex=20`
   - Should generate 20 problems (or maximum available)

4. **Default values:** `testecircuite.html`
   - Should use defaults: range=1,10, nr_ex=5

## Performance Testing

1. Open browser DevTools (F12)
2. Go to "Performance" or "Network" tab
3. Load a test page
4. Check:
   - Page load time (should be < 2 seconds)
   - Number of network requests
   - JavaScript execution time

## Cross-Browser Testing

Test in multiple browsers:
- [ ] Chrome/Edge (Chromium)
- [ ] Firefox
- [ ] Safari (if on Mac)
- [ ] Mobile browsers (responsive design)

## Common JavaScript Console Commands

Useful commands for debugging:

```javascript
// Check if data loaded
console.log(CIRCUIT_TESTS);

// Check test state
console.log(testState);

// Check sessionStorage
console.log(sessionStorage.getItem('testResults'));

// Clear sessionStorage
sessionStorage.clear();

// Test a specific formula
const formula = "((varR)*(varI))";
const vars = { varR: 10, varI: 5 };
console.log(evaluateFormulaWithVars(formula, vars));
```

## What Success Looks Like

When everything is working correctly, you should see:

1. **Home page:** Clean layout, all links work
2. **Test pages:** 
   - Circuit diagrams with numbers (not variable names)
   - Input fields for unknowns
   - No console errors
3. **After submission:**
   - Redirect to results page
   - Score displayed correctly
   - Each answer marked correct/incorrect
4. **Browser console:**
   - Debug logs showing test generation
   - Variable values and calculated answers
   - No error messages in red

## Ready for Deployment?

✅ All tests pass
✅ No console errors
✅ SVG diagrams display correctly
✅ Answers calculate correctly
✅ Results page shows proper feedback
✅ Tested in multiple browsers

If all above are checked, you're ready to deploy to GitHub Pages! See `DEPLOYMENT_GUIDE.md` for deployment instructions.

## Need Help?

If tests fail:
1. Check browser console for errors
2. Review this guide's debugging section
3. Verify all files are present in gh-pages folder
4. Try different browsers
5. Clear browser cache and try again
