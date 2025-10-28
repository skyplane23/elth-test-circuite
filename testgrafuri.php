<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EEquiz - Teste grafur</title>

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="css/resume.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Start Bootstrap</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile.png" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Despre noi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testeusoare.php?range=0,10&nr_ex=10">Teste usoare</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testegrafuri.php?range=0,10&nr_ex=10">Teste grafuri</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">
      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
          <h2 class="mb-5">Teste grafuri</h2>


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
			$file = range(54, 63);
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




			for($i = 0; $i < $nr_ex && $i < count($file); $i++) {
				echo '			<div class="resume-item d-flex flex-column flex-md-row mb-5">';
				echo '				<div class="resume-content mr-auto">';
				echo ' 				  <h3 class="mb-0">Problema '.($i+1).'</h3>';
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
					echo '<br><br>';
				}
				echo '<br>';
				echo ' 				</div>';
				echo '			</div>';
			}
			echo '<input type="submit">';
		}
		else {
			echo "Range missing";
			echo '<script>window.stop();</script>';
		}
	?>
		</div>

      </section>
    </div>

 
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/resume.min.js"></script>

  </body>

</html>
