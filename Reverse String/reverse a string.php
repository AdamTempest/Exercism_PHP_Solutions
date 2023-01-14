<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>reverse String</title>
        <style>
            body {
                background-color: black;
                color: white;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
    <?php

    function reverseString($str){
        $reversed = "";
        for ($i=strlen($str)-1;$i>=0;$i--){
            $reversed .= $str[$i];
        }  
        return $reversed;
    }

    $str = " ";
    echo "Reversed \"". $str ."\": ". reverseString($str) . "<br>";
    $str = "cool";
    echo "Reversed \"". $str ."\": ". reverseString($str) . "<br>";
    $str = "rigid";
    echo "Reversed \"". $str ."\": ". reverseString($str) . "<br>";
    $str = "digir";
    echo "Reversed \"". $str ."\": ". reverseString($str) . "<br>";
    $str = "looc";
    echo "Reversed \"". $str ."\": ". reverseString($str) . "<br>";

    ?>
    </body>
</html>