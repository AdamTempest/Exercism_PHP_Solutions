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

$result = accumulate([1,2,3],$accumulator);
echo "Square the numbers inside this [1,2,3]\n";
displayarr($result);
echo "\n";

$accumulator = function ($string) { 
		for ($i=0;$i<strlen($string);$i++){
			if (ord($string[$i]) >= 97 && ord($string[$i]) <= 122){ // if it's small letter
				$string[$i] = chr(90-(122-ord($string[$i])));        // capitalize the string
			}
		}
		return $string;
};

$result = accumulate(['Hello', 'World!'], $accumulator);
echo "Capitalize strings inside this ['Hello', 'World!']\n";
displayarr($result);
echo "\n";

$accumulator = function ($string) {
    return strrev($string);
};

$result = accumulate(['olleH', '!dlroW'], $accumulator);
echo "Reverse this ['olleH', '!dlroW']\n";
displayarr($result);
echo "\n";

$chars = ['a', 'b', 'c'];
$digits = [1, 2, 3];
$expected = [['a1', 'a2', 'a3'], ['b1', 'b2', 'b3'], ['c1', 'c2', 'c3']];

$result = accumulate($chars, function ($char) use ($digits) {
    return accumulate($digits, function ($digit) use ($char) {
        return $char . $digit;
    });
});
echo "Join ['a', 'b', 'c'] with [1, 2, 3] individually\n";
for ($j=0;$j<count($result);$j++){
	displayarr($result[$j]);
}
echo "\n";


// Additional points for making the following tests pass
$result = accumulate([" Hello\t", "\t World!\n "], 'trim');
echo "Trim this [\" Hello\\t\", \"\\t World!\\n \"]\n";
displayarr($result);
echo "\n";

$result = accumulate(['Hello', 'World!'], 'Str::len');
echo "Length of elements in ['Hello', 'World!']\n";
displayarr($result);
echo "\n";

class Str
{
    public static function len($string): int
    {
        return strlen($string);
    }
}
?>