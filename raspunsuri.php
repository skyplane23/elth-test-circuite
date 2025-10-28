<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EEquiz - Raspunsuri</title>

    
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
          <a href="acasa.php"><a href="acasa.php"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile.png" alt=""></a></a>
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Acasa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testecircuite.php?range=1,10&nr_ex=10">Teste circuite</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testegrafuri.php?range=1,10&nr_ex=10">Teste grafuri</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">
      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience">
        <div class="my-auto">
          <h2 class="mb-5">Raspunsuri</h2>
	
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
			echo '			<div class="resume-item d-flex flex-column flex-md-row mb-5">';
			echo '				<div class="resume-content mr-auto">';
			echo ' 				  <h3 class="mb-0">Problema '.($i+1).'</h3>';
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
				echo 'Rapunsul corect pentru problema '.($i+1).' este:'.$result.', iar tu ai raspuns:'.$_POST[$varunk[$x].$i].'<br>';
				if ($_POST[$varunk[$x].$i] == $result){
					$count += 1/count($varunk);
				}				
			}
			echo '<br>';
		}
		echo 'Ai rezolvat '.$count.' corect';
		echo ' 				</div>';
		echo '			</div>';
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
