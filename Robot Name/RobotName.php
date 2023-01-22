<?php

class Robot
{
    private $name="";
    private $history = [];
    private $names = array();
    private $length = 0;

    private function giveName(){
        $this->names = array();
        $random = rand(0,600000);
        for ($j=65;$j<=90;$j++){
            $val="";
            $f_letter = chr($j);
            $val = $f_letter;

            for ($k=65;$k<=90;$k++){
                $val = $f_letter . chr($k);
                $letter = $val;
                for ($l=0;$l<10;$l++){
                    $val = $letter;
                    $val .= "00$l";
                    array_push($this->names,$val);
                    
                }
                for ($m=10;$m<100;$m++){
                    $val = $letter;
                    $val .= "0$m";
                    array_push($this->names,$val);
                    
                }
                for ($n=100;$n<1000;$n++){
                    $val = $letter;
                    $val .= $n;
                    array_push($this->names,$val);
                    
                }
                if (count($this->names) > $random){
                    $this->length = count($this->names);
                    return $this->names[$random];
                }
            }
        }
            // AA000 - 0 th iteration
            // AA001
            // AA002
            // AA999 - 999 th iteration
            // AB000 - 1000 th iteration
            // AB001 - 1000 th iteration
            // AC000 - 2000 th iteration
            // AD000 - 3000 th iteration
            // AD999 - 3999 th iteration
            // AE000 - 4000 th iteration
            
            // 4691 th iteration - AE691
            // 5000 th iteration - AF000
            // 10000 th iteration - AK000
            // 11000 l 
            // 12000 m
            // 13000 n
            // 14000 o
            // 15000 p
            // 16000 q
            // 17000 r
            // 18000 s
            // 19000 t
            // 20000 u
            // 21000 v
            // 22000 w
            // 23000 x
            // 24000 y
            // 25000 th iteration - AZ000
            // 25999 th iteration - AZ999
            // 26000 th iteration - BA000
            // 27000 th iteration - BB000
            // 28000 th iteration - BC000
            // 30000 th iteration - BE000
            // 35000 th iteration - BJ000
            // 40000 th iteration - BO000
            // 45555 th iteration - BT555
            // 52000 th iteration - CA000
            // 624,375 th iteration - YA375
            // 675,324 th iteration - ZB324
            // 650,000
            // ZZ999 - 999
            // 
            // 675
            // algorithm: chr(65 + ((n/1000) / 26)) = First letter
            //            chr(65 + ((n/1000) % 26)) = Second Letter
            //            n % 1000 = numbers

        $res = $this->names[$random];

        return $res;
    }

    public function __construct()
    {
        $this->name = $this->giveName();
    }

    public function getName()
    {
        return $this->name;
    }

    public function reset()
    {
        $this->name = $this->names[rand(0,$this->length)];
        for ($i=0;$i<count($this->history);$i++){
            if ($this->name == $this->history[$i]){
                $this->name = $this->names[rand(0,$this->length)];
                break;
            }
        }
        array_push($this->history,$this->name);
    }
}



// $bob = new Robot();
// echo "Name: ".$bob->getName() . "\n";
// echo "Reset Name.\n";
// $bob->reset();
// echo "New Name: " . $bob->getName(). "\n";

// echo "Does it repeat after 1000 iterations?\n";
// $arr = array();
// $repeat = false;
// for ($i=0;$i<1000;$i++){
//     $joe = new Robot();
//     // check if it's in array
//     for ($j=0;$j<count($arr);$j++){
//         if ($joe->getName()==$arr[$j]){
//             echo "Yes. It does repeat in $i th iteration.\n";
//             $repeat = true;
//             break;
//         }
//     }
//     if ($repeat){
//         break;
//     } else{
//         // echo "[$i] Nope.\n";
//         array_push($arr,$joe->getName());
//     }
// }
// if (!($repeat)){
//     echo "Congrats !!! \n It doesn't repeat.\n";
// }

?>