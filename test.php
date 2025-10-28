<?php
	function evalmath($equation)
	{
		$result = 0;
		// sanitize input
		$equation = preg_replace("/[^0-9+\-.*\/()%]/","",$equation);
		
		// No longer converting alphabet to $variables
		// We'll rely on direct numeric substitution instead
		
		// convert percentages to decimal
		$equation = preg_replace("/([+-])([0-9]{1})(%)/","*(1\$1.0\$2)",$equation);
		$equation = preg_replace("/([+-])([0-9]+)(%)/","*(1\$1.\$2)",$equation);
		$equation = preg_replace("/([0-9]{1})(%)/",".0\$1",$equation);
		$equation = preg_replace("/([0-9]+)(%)/",".\$1",$equation);
		
		if ( $equation != "" ){
			try {
				$result = eval("return " . $equation . ";" );
				if ($result === null) {
					throw new Exception("Unable to calculate equation");
				}
			} catch (Throwable $e) {
				throw new Exception("Unable to calculate equation: " . $e->getMessage());
			}
		}
		
		return $result;
	}
	
	$count = 0;
	$vars = $_POST['vars'] ?? '';
	$vars = explode(';' , $vars);
	
	// Create a variable map for easier lookup
	$varMap = [];
	foreach ($vars as $varPair) {
		$pair = explode('=' , $varPair);
		if (count($pair) >= 2) {
			$varMap[$pair[0]] = $pair[1];
		}
	}
	
	// Process first formula
	try {
		$formula = "varR*varI";
		// First replace all variables with their numeric values
		foreach ($varMap as $varName => $varValue) {
			$formula = str_replace($varName, $varValue, $formula);
		}
		
		// Now we should have a formula with only numbers and operators
		$result = evalmath($formula);
		if (isset($_POST['tensiune']) && $_POST['tensiune'] == $result){
			$count++;
		}
		echo 'Raspunsul corect este: ' . ($_POST['tensiune'] ?? 'nedefinit') . ', iar tu ai raspuns: ' . $result . '<br>';
	} catch (Exception $e) {
		echo 'Eroare la calculul tensiunii: ' . $e->getMessage() . '<br>';
	}
	
	// Process second formula
	try {
		$formula = "varG*(varV1-varV2)";
		foreach ($varMap as $varName => $varValue) {
			$formula = str_replace($varName, $varValue, $formula);
		}
		
		$result = evalmath($formula);
		if (isset($_POST['intensitate']) && $_POST['intensitate'] == $result){
			$count++;
		}
		echo 'Raspunsul corect este: ' . ($_POST['intensitate'] ?? 'nedefinit') . ', iar tu ai raspuns: ' . $result . '<br>';
	} catch (Exception $e) {
		echo 'Eroare la calculul intensitatii: ' . $e->getMessage() . '<br>';
	}
	
	// Process third formula
	try {
		$formula = "var1R*var1I";
		foreach ($varMap as $varName => $varValue) {
			$formula = str_replace($varName, $varValue, $formula);
		}
		
		$result = evalmath($formula);
		if (isset($_POST['tensiuneE']) && $_POST['tensiuneE'] == $result){
			$count++;
		}
		echo 'Raspunsul corect este: ' . ($_POST['tensiuneE'] ?? 'nedefinit') . ', iar tu ai raspuns: ' . $result . '<br>';
	} catch (Exception $e) {
		echo 'Eroare la calculul tensiunii E: ' . $e->getMessage() . '<br>';
	}
	
	echo 'Ai rezolvat ' . $count . ' corect';
?>
