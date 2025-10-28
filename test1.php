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

    echo $result;
   // return $equation;
}
	$test = "(a*b)";
	$a = 8;
	$b = 3;
	$test = str_replace('a',$a,$test);
	$test = str_replace('b',$b,$test);
	evalmath($test);
?>