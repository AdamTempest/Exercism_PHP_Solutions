<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Giga Second</title>
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

    function from(DateTimeImmutable $date) {
        $interval = DateInterval::createFromDateString('1000000000 seconds');
        $newDate = $date->add($interval);
        return $newDate;
    }
    
    $inputAndExpectedOutputs = [['2011-04-25', '2043-01-01 01:46:40'], 
                                ['1977-06-13', '2009-02-19 01:46:40'], 
                                ['1959-07-19', '1991-03-27 01:46:40'], 
                                ['2015-01-24 22:00:00', '2046-10-02 23:46:40'], 
                                ['2015-01-24 23:59:59', '2046-10-03 01:46:39']];

    for($i=0;$i<count($inputAndExpectedOutputs);$i++){
        $UTC = new DateTimeZone('UTC');
        $ipdt = $inputAndExpectedOutputs[$i][0];
        $date = new DateTimeImmutable($ipdt,$UTC);
        
        echo "Input: " . $ipdt . "<br>\n"; 
        echo "Output:   " . from($date)->format('Y-m-d H:i:s');
        echo "Expected: " . $inputAndExpectedOutputs[$i][1]."<br>\n";
        echo "\n";
    }

    ?>
    </body>
</html>