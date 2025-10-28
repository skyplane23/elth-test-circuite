<html>
<head>

</head>
<body>
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
		
		function get_numitor($formula) {
			$ok = 0;
			$numitor = "";
			$open = 0;
			$close = 0;
			
			foreach(str_split($formula) as $char){
				if($ok == 1) {
					if (strpos($char, '(') !== false) {
						$open++;
					}
					if (strpos($char, ')') !== false) {
						$close++;
					}
					if($open >= $close) {
							$numitor .= $char;
					}
					else {
						$ok = 0;
					}
				}
				if (strpos($char, '/') !== false && $ok == 0) {
					$ok = 1;
				}
			}
			
			return $numitor;
		}
		
		function get_numarator($formula) {
			$ok = 0;
			$numarator = "";
			$open = 0;
			$close = 0;
			
			for($i = 0; $i < strlen($formula); $i++) {
				if (strpos($formula[$i], '/') !== false && $ok == 0) {
					$i--;
					break;
				}
			}
			
			while($i >= 0){
				if (strpos($formula[$i], '(') !== false) {
					$open++;
				}
				if (strpos($formula[$i], ')') !== false) {
					$close++;
				}
				if($close >= $open) {
						$numarator .= $formula[$i];
				}
				else {
					$i = -1;
				}
				$i--;
			}
			
			return strrev($numarator);
		}
		
		function fraction($formula, $vars, $range) {
			$numitor = get_numitor($formula);
			$numarator = get_numarator($formula);
			foreach (explode(',' , $vars) as $var) {
				$var = explode('=' , $var);
				if (strpos($numitor, $var[0]) !== false) {
					$valnumitor = str_replace($var[0],$var[1],$numitor);
				}	
			}
			$valnumitor = evalmath($valnumitor);
			if($valnumitor == 0) {
				while ($valnumitor == 0) {
					foreach (explode(',' , $vars) as $var) {
						$old_var = $var;
						$var = explode('=' , $var);
						if (strpos($numitor, $var[0]) !== false) {
							$new_var = str_replace($var[1],rand($range[0],$range[1]),$old_var);
							$vars = str_replace($old_var,$new_var,$vars);
						}	
					}
					foreach(explode(',' , $vars) as $var) {
						$var = explode('=' , $var);
						if (strpos($numitor, $var[0]) !== false) {
							$valnumitor = str_replace($var[0],$var[1],$numitor);
						}	
					}
					$valnumitor = evalmath($valnumitor);
				}
			}
			foreach (explode(',' , $vars) as $var) {
						$old_var = $var;
						$var = explode('=' , $var);
						if (strpos($numarator, $var[0]) !== false) {
							$new_var = str_replace($var[1],rand(-4,4)*$valnumitor,$old_var);
							$vars = str_replace($old_var,$new_var,$vars);
						}	
			}
			return $vars;
		}
	
		if(isset($_GET['nr_ex'])) {
			$nr_ex = $_GET['nr_ex'];
			if($nr_ex < 1) {
				$nr_ex = 3;
			}
		}	
		else {
			$nr_ex = 3;
		}
		if(isset($_GET['range'])) {
			echo '<form action="testv2.php" method="post">';
			$vars = "";
			$unknown = "";
			$formulas = "";
			$range = explode(',' , $_GET['range']);
			$file = range(26, 28);
			shuffle($file);
			for($i = 0; $i < $nr_ex; $i++) {
				$handle = fopen("testinfo/test".$file[$i], "r");
				if ($handle) {
					$line = fgets($handle);
					$line = explode(';' , $line);
					foreach (explode(',' , $line[0]) as $var) {
						$line[0] = str_replace($var,$var.'='.(rand($range[0],$range[1])),$line[0]);
					}
					$vars = $vars.$line[0];
					$unknown = $unknown.$line[1];
					$formulas = $formulas.$line[2];
					foreach (explode(',' , $line[2]) as $form) {
						if (strpos($form, '/') !== false) {
							$vars = str_replace($line[0],fraction($form, $line[0], $range),$vars);
						}
					}
					if($i < $nr_ex - 1) {
						$vars = $vars.';';
						$unknown = $unknown.';';
						$formulas = $formulas.';';
					}
				}
				
			}
			echo '<input type="hidden" name="vars" value="'.$vars.'" />';
			echo '<input type="hidden" name="unknown" value="'.$unknown.'" />';
			echo '<input type="hidden" name="formulas" value="'.$formulas.'" />';
			echo '<input type="hidden" name="nr_ex" value="'.$nr_ex.'" />';
			$vars = explode(';' , $vars);
			$unknown = explode(';' , $unknown);
			for($i = 0; $i < $nr_ex; $i++) {
				$handle = fopen("testsvg/test".$file[$i]."-1.svg", "r");
				if ($handle) {
					while (($line = fgets($handle)) !== false) {
						foreach (explode(',' , $vars[$i]) as $var) {
							$var = explode('=' , $var);
							if (strpos($line, $var[0]) !== false) {
								$line = str_replace($var[0],$var[1],$line);
							}	
						}
						echo $line;
					}
				}
				echo '<br><br>';
				foreach (explode(',' , $unknown[$i]) as $var) {
					echo  $var.'= <input type="text" name="'.$var.'">';
					echo '<br>';
				}
				echo '<br>';
			}
			echo '<input type="submit">';
		}
		else {
			echo "Range missing";
			echo '<script>window.stop();</script>';
		}
	?>
</body>
</html>