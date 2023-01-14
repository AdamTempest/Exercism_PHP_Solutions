<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>hamming distance</title>
        <style>
            body {
                background-color: black;
                color: white;
                font-size: 30px;
            }
        </style>
    </head>
    <body>
    <?php
    function distance($a,$b){
        if (strlen($a) != strlen($b)){
            throw new InvalidArgumentException('DNA strands must be of equal length.');
        }
        $differences = 0;
        for ($i=0;$i<strlen($a);$i++){
            if ($a[$i]!=$b[$i]){
                echo $a[$i] . " " . $b[$i] . "<br>";
                $differences+=1;
            }
        }
        return $differences;
    }

    echo "Hamming distance between 'A' and 'A' is " . distance('A', 'A') . "<br>";
    echo "Hamming distance between 'A' and 'G' is " . distance('A', 'G') . "<br>";
    echo "Hamming distance between 'AG' and 'CT' is " . distance('AG', 'CT') . "<br>";
    echo "Hamming distance between 'AT' and 'CT' is " . distance('AT', 'CT') . "<br>";
    echo "Hamming distance between 'GGACG' and 'GGTCG' is " . distance('GGACG', 'GGTCG') . "<br>";
    echo "Hamming distance between 'GATACA' and 'GCATAA' is " . distance('GATACA', 'GCATAA') . "<br>";   
    echo "Hamming distance between 'GGACGGATTCTG' and 'AGGACGGATTCT' is " . distance('GGACGGATTCTG', 'AGGACGGATTCT') . "<br>";
    echo "Hamming distance between 'GGACG' and 'AGGACGTGG' is " . distance('GGACG', 'AGGACGTGG')."<br>";
    

    ?>
</body>
</html>