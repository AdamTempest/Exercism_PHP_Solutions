<?php

class Robot
{
    private $name="";
    private $history=[];

    private function giveName(){
        $n="";
        $n.=chr(rand(65,90));
        $n.=chr(rand(65,90));
        $n.=rand(0,9);
        $n.=rand(0,9);
        $n.=rand(0,9);
        return $n;
    }

    public function __construct()
    {
        $this->name = $this->giveName();
        
        // checking if it's used before 
        for ($i=0;$i<count($this->history);$i++){
            if ($this->name == $this->history[$i]){
                $this->name = $this->giveName();
                break;
            }
        }
        array_push($this->history,$this->name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function reset()
    {
        $this->name = $this->giveName();
    }
}
$bob = new Robot();
echo "Name: ".$bob->getName() . "\n";
echo "Reset Name.\n";
$bob->reset();
echo "New Name: " . $bob->getName(). "\n";

?>