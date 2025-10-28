// EEquiz - Shared Utilities for Static Site
// Replaces PHP server-side logic with client-side JavaScript

/**
 * Evaluates a mathematical expression safely
 * Replaces the PHP evalmath function
 * @param {string} equation - The equation to evaluate
 * @returns {number} - The result
 */
function evalMath(equation) {
    try {
        // Sanitize input - only allow numbers, operators, parentheses
        equation = equation.replace(/[^a-z0-9+\-.*\/()%]/gi, '');
        
        // Convert percentages to decimal (simplified version)
        equation = equation.replace(/(\d+)%/g, (match, num) => `(${num}/100)`);
        
        // Safely evaluate using Function constructor (safer than eval)
        // Remove variable prefixes if any remain
        equation = equation.replace(/var([A-Z][a-z0-9]*)/g, '$1');
        
        const result = Function('"use strict"; return (' + equation + ')')();
        return result;
    } catch (e) {
        console.error('Error evaluating equation:', equation, e);
        return 0;
    }
}

/**
 * Get the denominator from a formula containing division
 * @param {string} formula - The formula string
 * @returns {string} - The denominator part
 */
function getDenominator(formula) {
    let denominator = '';
    let foundDivision = false;
    let openParens = 0;
    let closeParens = 0;
    
    for (let i = 0; i < formula.length; i++) {
        const char = formula[i];
        
        if (foundDivision) {
            if (char === '(') openParens++;
            if (char === ')') closeParens++;
            
            if (openParens >= closeParens) {
                denominator += char;
            } else {
                break;
            }
        }
        
        if (char === '/' && !foundDivision) {
            foundDivision = true;
        }
    }
    
    return denominator;
}

/**
 * Get the numerator from a formula containing division
 * @param {string} formula - The formula string
 * @returns {string} - The numerator part
 */
function getNumerator(formula) {
    let numerator = '';
    let openParens = 0;
    let closeParens = 0;
    
    // Find the division operator first
    let divIndex = formula.indexOf('/');
    if (divIndex === -1) return '';
    
    // Walk backwards from the division
    let i = divIndex - 1;
    
    while (i >= 0) {
        const char = formula[i];
        
        if (char === '(') openParens++;
        if (char === ')') closeParens++;
        
        if (closeParens >= openParens) {
            numerator = char + numerator;
        } else {
            break;
        }
        
        i--;
    }
    
    return numerator;
}

/**
 * Handle fraction formulas to avoid division by zero
 * @param {string} formula - The formula
 * @param {Object} varValues - Object with variable values {varName: value}
 * @param {Array} range - [min, max] for random generation
 * @returns {Object} - Updated variable values
 */
function handleFraction(formula, varValues, range) {
    if (!formula.includes('/')) return varValues;
    
    const denominator = getDenominator(formula);
    if (!denominator) return varValues;
    
    // Evaluate denominator with current values
    let denominatorValue = evaluateFormulaWithVars(denominator, varValues);
    
    // If denominator is zero, regenerate values
    let attempts = 0;
    while (denominatorValue === 0 && attempts < 100) {
        // Find variables in denominator and regenerate them
        const varsInDenom = Object.keys(varValues).filter(v => denominator.includes(v));
        varsInDenom.forEach(varName => {
            varValues[varName] = Math.floor(Math.random() * (range[1] - range[0] + 1)) + range[0];
        });
        
        denominatorValue = evaluateFormulaWithVars(denominator, varValues);
        attempts++;
    }
    
    // Set numerator variables to multiples of denominator
    const numerator = getNumerator(formula);
    if (numerator && denominatorValue !== 0) {
        const varsInNum = Object.keys(varValues).filter(v => numerator.includes(v));
        varsInNum.forEach(varName => {
            const multiplier = Math.floor(Math.random() * 9) - 4; // -4 to 4
            varValues[varName] = multiplier * denominatorValue;
        });
    }
    
    return varValues;
}

/**
 * Evaluate a formula by substituting variable values
 * @param {string} formula - The formula with variable names
 * @param {Object} varValues - Object with variable values
 * @returns {number} - The calculated result
 */
function evaluateFormulaWithVars(formula, varValues) {
    let evaluatedFormula = formula;
    
    // Sort variable names by length (longest first) to avoid partial matches
    const sortedVarNames = Object.keys(varValues).sort((a, b) => b.length - a.length);
    
    // Replace each variable with its value, wrapped in parentheses
    sortedVarNames.forEach(varName => {
        // Escape special regex characters and use word boundary for exact match
        const escapedVarName = varName.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp('\\b' + escapedVarName + '\\b', 'g');
        evaluatedFormula = evaluatedFormula.replace(regex, `(${varValues[varName]})`);
    });
    
    return evalMath(evaluatedFormula);
}

/**
 * Generate random variable values for a test
 * @param {Array} variables - Array of variable names
 * @param {Array} formulas - Array of formulas
 * @param {Array} range - [min, max] for random values
 * @returns {Object} - Object with variable:value pairs
 */
function generateVariableValues(variables, formulas, range) {
    const varValues = {};
    
    // Generate initial random values
    variables.forEach(varName => {
        varValues[varName] = Math.floor(Math.random() * (range[1] - range[0] + 1)) + range[0];
    });
    
    // Handle fractions to avoid division by zero
    formulas.forEach(formula => {
        if (formula.includes('/')) {
            handleFraction(formula, varValues, range);
        }
    });
    
    return varValues;
}

/**
 * Replace variables in SVG content with their values
 * @param {string} svgContent - The SVG file content
 * @param {Object} varValues - Variable values
 * @returns {string} - SVG with substituted values
 */
function replaceSVGVariables(svgContent, varValues) {
    let modifiedSVG = svgContent;
    
    // Sort variable names by length (longest first) to avoid partial matches
    const sortedVarNames = Object.keys(varValues).sort((a, b) => b.length - a.length);    
    sortedVarNames.forEach(varName => {
        // Escape special regex characters and use word boundary for exact match
        modifiedSVG = modifiedSVG.replace(varName, varValues[varName]);
    });
    
    return modifiedSVG;
}

/**
 * Calculate the correct answers for a test
 * @param {Object} test - Test data with formulas
 * @param {Object} varValues - Variable values
 * @returns {Object} - Object with unknown:answer pairs
 */
function calculateAnswers(test, varValues) {
    const answers = {};
    
    test.unknowns.forEach((unknown, index) => {
        const formula = test.formulas[index];
        const result = evaluateFormulaWithVars(formula, varValues);
        answers[unknown] = result;
    });
    
    return answers;
}

/**
 * Shuffle an array (Fisher-Yates algorithm)
 * @param {Array} array - Array to shuffle
 * @returns {Array} - Shuffled array
 */
function shuffleArray(array) {
    const shuffled = [...array];
    for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
    }
    return shuffled;
}

/**
 * Get URL parameters
 * @param {string} param - Parameter name
 * @returns {string|null} - Parameter value
 */
function getURLParameter(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

/**
 * Parse range parameter "min,max" to array [min, max]
 * @param {string} rangeStr - Range string like "1,10"
 * @returns {Array} - [min, max]
 */
function parseRange(rangeStr) {
    if (!rangeStr) return [1, 10]; // default
    const parts = rangeStr.split(',').map(n => parseInt(n.trim()));
    return parts.length === 2 ? parts : [1, 10];
}
