# EEquiz - Electrical Engineering Quiz Platform

EEquiz is an interactive quiz platform for electrical engineering circuit and graph problems. The application randomly generates problems with different variable values and validates user answers.

## Project Versions

This project has **two versions** that serve different deployment scenarios:

### 1. PHP Version (Root Directory)
- **Location**: Root directory (`/`)
- **Technology**: PHP backend with server-side rendering
- **Files**: `testecircuite.php`, `testegrafuri.php`, `raspunsuri.php`
- **Test Data**: `testinfo/` folder (plain text files)
- **SVG Files**: `testsvg/` folder
- **Deployment**: Docker container with Nginx

### 2. Static HTML Version (GitHub Pages)
- **Location**: `gh-pages/` folder
- **Technology**: Pure HTML/JavaScript (client-side)
- **Files**: `testecircuite.html`, `testegrafuri.html`, `raspunsuri.html`
- **Test Data**: `gh-pages/data/testdata.js` (JavaScript)
- **SVG Files**: `gh-pages/testsvg/` folder
- **Deployment**: GitHub Pages or any static hosting

## Getting Started

### Running the PHP Version

#### Prerequisites
- Docker and Docker Compose installed on your system

#### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd elth-test-circuite
   ```

2. **Start the Docker container**
   ```bash
   docker-compose up -d
   ```

3. **Access the application**
   - Open your browser and navigate to: `http://localhost:8080`
   - Navigate to:
     - Circuit Tests: `http://localhost:8080/testecircuite.php?range=1,10&nr_ex=10`
     - Graph Tests: `http://localhost:8080/testegrafuri.php?range=1,10&nr_ex=10`

4. **Stop the container**
   ```bash
   docker-compose down
   ```

#### URL Parameters
- `range`: Value range for variables (e.g., `1,10` generates values between 1 and 10)
- `nr_ex`: Number of problems to generate (e.g., `10` generates 10 problems)

### Running the Static HTML Version

#### Option 1: Local Development

1. **Navigate to the gh-pages folder**
   ```bash
   cd gh-pages
   ```

2. **Start a local web server**
   ```bash
   # Using Python 3
   python -m http.server 8000
   
   # Or using PHP
   php -S localhost:8000
   
   # Or using Node.js (with npx)
   npx http-server -p 8000
   ```

3. **Access the application**
   - Open your browser and navigate to: `http://localhost:8000`
   - Navigate to:
     - Circuit Tests: `http://localhost:8000/testecircuite.html?range=1,10&nr_ex=10`
     - Graph Tests: `http://localhost:8000/testegrafuri.html?range=1,10&nr_ex=10`

#### Option 2: GitHub Pages Deployment

1. Push the `gh-pages` folder content to the `gh-pages` branch
2. Enable GitHub Pages in your repository settings
3. Access via: `https://yourusername.github.io/repository-name/`

## Adding New Tests

### Adding Tests to the PHP Version

1. **Create test data file**
   - Navigate to `testinfo/` folder
   - Create a new file named `testN` (where N is the next number)
   - Format: `variables;unknowns;formulas`
   
   **Example** (`testinfo/test64`):
   ```
   varI,varR;u;((varR)*(varI))
   ```
   
   This defines:
   - **Variables**: `varI`, `varR` (will get random values)
   - **Unknown**: `u` (what the user must calculate)
   - **Formula**: `u = varR × varI` (Ohm's Law)

2. **Create SVG diagram**
   - Navigate to `testsvg/` folder
   - Create a file named `testN-1.svg` (matching the test number)
   - Include variable placeholders in the SVG using the variable names (e.g., `varI`, `varR`)
   - The PHP script will automatically replace these with generated values

3. **Update test range in code**
   - Open `testecircuite.php` (for circuits) or `testegrafuri.php` (for graphs)
   - Find the line: `$file = range(1, 53);`
   - Update the range to include your new test: `$file = range(1, 64);`

### Adding Tests to the Static HTML Version

1. **Add test data to JavaScript file**
   - Open `gh-pages/data/testdata.js`
   - Add a new test object to the appropriate array (`CIRCUIT_TESTS` or `GRAPH_TESTS`)
   
   **Example**:
   ```javascript
   {
     id: 64,
     variables: [
       "varI",
       "varR"
     ],
     unknowns: [
       "u"
     ],
     formulas: [
       "((varR)*(varI))"
     ]
   }
   ```

2. **Create SVG diagram**
   - Navigate to `gh-pages/testsvg/` folder
   - Create a file named `test64-1.svg` (matching the ID)
   - Include variable placeholders in the SVG using the variable names

3. **Update test range in code**
   - Open `gh-pages/testecircuite.html` (for circuits) or `gh-pages/testegrafuri.html` (for graphs)
   - Find the line: `const availableTests = CIRCUIT_TESTS.filter(t => t.id >= 1 && t.id <= 53);`
   - Update the range: `const availableTests = CIRCUIT_TESTS.filter(t => t.id >= 1 && t.id <= 64);`

## Test Data Format

### Variables
Comma-separated list of variable names that will receive random values from the specified range.

### Unknowns
Comma-separated list of variables that the user must calculate.

### Formulas
Mathematical expressions using the variables. Supported operations:
- Addition: `+`
- Subtraction: `-`
- Multiplication: `*`
- Division: `/`
- Parentheses: `(` `)`

**Examples**:
- Ohm's Law: `((varR)*(varI))`
- Voltage divider: `((varR1*varU)/(varR1+varR2))`
- Complex: `(((varR1*varR2)/(varR1+varR2))*varI)`

## Project Structure

```
elth-test-circuite/
├── testecircuite.php        # PHP circuit tests
├── testegrafuri.php          # PHP graph tests
├── raspunsuri.php            # PHP answer validation
├── testinfo/                 # PHP test data (text files)
├── testsvg/                  # PHP SVG diagrams
├── docker-compose.yml        # Docker configuration
├── Dockerfile                # Docker image definition
├── gh-pages/                 # Static HTML version
│   ├── testecircuite.html    # HTML circuit tests
│   ├── testegrafuri.html     # HTML graph tests
│   ├── raspunsuri.html       # HTML answer display
│   ├── data/
│   │   └── testdata.js       # JavaScript test data
│   ├── testsvg/              # HTML SVG diagrams
│   └── js/
│       ├── utils.js          # Utility functions
│       └── resume.js         # UI scripts
└── vendor/                   # Bootstrap & jQuery libraries
```

## Development Notes

- Both versions use the same Bootstrap template for consistent UI
- SVG files must be numbered to match test IDs (e.g., `test1-1.svg` for test 1)
- Variable names in SVG files are replaced at runtime with generated values
- The system automatically handles division by zero and generates valid test cases
- Answer validation uses a tolerance of ±0.01 for floating-point comparison

## Project Information

**EEquiz** - Aplicație pentru exersarea cunoștințelor de electrotehnică

**SCSS-ELTH MAI 2018**

### Realizatori (Creators)
- Liviu-Nicolae Moraru
- Andreea-Diana Oltean
- Stefan Vodita

### Profesor Coordonator (Coordinating Professor)
- Gabriela Ciuprina

## Template Credits

This project is built on the [Start Bootstrap - Resume](https://startbootstrap.com/template-overviews/resume/) template created by [Start Bootstrap](http://startbootstrap.com/).

## Copyright and License

Copyright 2013-2018 Blackrock Digital LLC. Code released under the [MIT](https://github.com/BlackrockDigital/startbootstrap-resume/blob/gh-pages/LICENSE) license.
