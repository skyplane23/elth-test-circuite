<?php
	function evalmath($equation)
	{
		$result = 0;
		// sanitize imput
		$equation = preg_replace("/[^a-z0-9+\-.*\/()%]/","",$equation);
		// convert alphabet to $variabel 
		$equation = preg_replace("/([a-z])+/i", "\$$0", $equation); 
		// convert percentages to decimal
		$equation = preg_replace("/([+-])([0-9]{1})(%)/","*(1\$1.0\$2)",$equation);
		$equation = preg_replace("/([+-])([0-9]+)(%)/","*(1\$1.\$2)",$equation);
		$equation = preg_replace("/([0-9]{1})(%)/",".0\$1",$equation);
		$equation = preg_replace("/([0-9]+)(%)/",".\$1",$equation);
		if ( $equation != "" ){
			$result = @eval("return " . $equation . ";" );
		}
		return $result;
	}
	$count = 0;
	$unknown = explode(';' , $_POST['unknown']);
	$formula = explode(';' , $_POST['formulas']);
	$vars = explode(';' , $_POST['vars']);
	$nr_ex = $_POST['nr_ex'];
	for($i = 0; $i < $nr_ex; $i++) {
		$varunk = explode(',' , $unknown[$i]);
		$varform = explode(',' , $formula[$i]);
		for($x = 0; $x < count($varunk); $x++) {
			foreach (explode(',' , $vars[$i]) as $var) {
				$var = explode('=' , $var);
				if (strpos($varform[$x], $var[0]) !== false) {
					$varform[$x] = str_replace($var[0],'('.$var[1].')',$varform[$x]);
				}
			}
			$result = evalmath($varform[$x]);
			echo 'Rapunsul corect este:'.$result.', iar tu ai raspuns:'.$_POST[$varunk[$x]].'<br>';
			if ($_POST[$varunk[$x]] == $result){
				$count += 1/count($varunk);
			}				
		}
		echo '<br>';
	}
	echo 'Ai rezolvat '.$count.' corect';
?>