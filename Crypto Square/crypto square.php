<?php

function toSmall($dec){
    return chr(122-(90-$dec));
}

function crypto_square($msg){
    $new_msg = "";

    // downcasing and removing punctuation and spaces
    for ($i=0;$i<strlen($msg);$i++)
    {
        $char = $msg[$i];
        $dec = ord($char);

        $con1 = 97<=$dec && $dec<=122;
        $con2 = 48<=$dec && $dec<=57;
        if ($con1 || $con2){     // if it's small letter
            $new_msg = $new_msg . $char;// add to new_msg
        } 
        else if (65<=$dec && $dec<=90){         // if it's capital letter
            $new_msg = $new_msg . toSmall($dec);// downcase it and add to new_msg
        }
    }

    // create square
    $len = strlen($new_msg);
    $row = 0;
    $col = 0;
    
    if ($len <= 1) {
        return $new_msg;
    }

    // find row and column
    for ($i=1;$i<$len;$i++)
    { 
        $x = $i*$i;
        $y = $i*($i+1);

        if ($x >= $len)
        {
            $col = $i;
            $row = $i;
            break;
        }
        else if ($y >= $len)
        {
            $col = $i+1;
            $row = $i;
            break;
        }
    }

    // making rectangle array
    $arr=[]; $count = 0; $id=0; $line="";
    for ($j=0;$j<$len-1;$j++)
    {
        $e = $new_msg[$j];
        $line = $line.$e;
        $count+=1;
        if ($count == $col)
        {
            $arr[$id] = $line;
            $line = "";
            $count = 0;
            $id += 1;
        }
    }
    $line = $line.$new_msg[$len-1];
    while (strlen($line)<$col){ 
        $line = $line." ";
    }
    $arr[$id] = $line;
    $line = "";


    // encoding the string
    $arr2=[];
    for ($c=0; $c < $col; $c++) {
        for ($r=0; $r < $row ; $r++) 
        {
            if ($c < strlen($arr[$r]))
            {
                $line = $line .$arr[$r][$c];
            } else 
            {
                break;
            }
        }
        $arr2[$c] = $line;
        $line     = "";
    }

    $result = "";
    for($k=0;$k<count($arr2)-1;$k++){
        $result = $result . $arr2[$k] . " ";
    }
    $result = $result . $arr2[count($arr2)-1];
    return $result;
}


// test cases
$inpt = "";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = "A";
$result = crypto_square($inpt); 
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = " b ";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = "This is fun!";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = "Chill out.";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = "@1,%!";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

$inpt = "If man was meant to stay on the ground, god would have given us roots.";
$result = crypto_square($inpt);
echo "Input:  $inpt<br>";
echo "Result: $result<br><br>";

?>