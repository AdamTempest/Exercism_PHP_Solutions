<?php

class Robot
{
    private $name="";

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