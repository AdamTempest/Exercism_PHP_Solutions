<?php

function accumulate(array $input, callable $accumulator): array
{
	for ($i=0;$i<count($input);$i++){
		$input[$i] = $accumulator($input[$i]);
	}
	return $input;
}

function displayarr($arr){
	for ($i=0;$i<count($arr);$i++){
		echo $arr[$i], " ";
	}
	echo "\n";
}

$accumulator = function ($value) {
    return $value ** 2;
};

$result = accumulate([],$accumulator);
displayarr($result);

$result = accumulate([1,2,3],$accumulator);
displayarr($result);

$accumulator = function ($string) { 
		for ($i=0;$i<strlen($string);$i++){
			if (ord($string[$i]) >= 97 && ord($string[$i]) <= 122){ // if it's small letter
				$string[$i] = chr(90-(122-ord($string[$i])));        // capitalize the string
			}
		}
		return $string;
};

$result = accumulate(['Hello', 'World!'], $accumulator);
displayarr($result);	
?>