<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Robot Simulator</title>
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

    
// turn right
// turn left
// advance
class Robot
{
    const DIRECTION_NORTH = "n";
    const DIRECTION_SOUTH = "s";
    const DIRECTION_EAST  = "e";
    const DIRECTION_WEST  = "w";

    /**
     *
     * @var int[]
     */
    public $position;

    /**
     *
     * @var string
     */
    public $direction;

    public function __construct(array $position, string $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function turnRight()
    {
        switch ($this->direction) {
            case $this::DIRECTION_NORTH:
                $this->direction = $this::DIRECTION_EAST;
                break;
            
            case $this::DIRECTION_EAST:
                $this->direction = $this::DIRECTION_SOUTH;
                break;
            
            case $this::DIRECTION_SOUTH:
                $this->direction = $this::DIRECTION_WEST;
                break;
            
            case $this::DIRECTION_WEST:
                $this->direction = $this::DIRECTION_NORTH;
                break;
            
            default:
                break;
        }
        return $this; // for method chaining
    }

    public function turnLeft()
    {
        switch ($this->direction) {
            case $this::DIRECTION_NORTH:
                $this->direction = $this::DIRECTION_WEST;
                break;
            
            case $this::DIRECTION_EAST:
                $this->direction = $this::DIRECTION_NORTH;
                break;
            
            case $this::DIRECTION_SOUTH:
                $this->direction = $this::DIRECTION_EAST;
                break;
            
            case $this::DIRECTION_WEST:
                $this->direction = $this::DIRECTION_SOUTH;
                break;
            
            default:
                break;
        }
        return $this; // for method chaining
    }

    public function advance()
    {
        switch ($this->direction) {
            case $this::DIRECTION_NORTH:
                $this->position[1] += 1; // arr[]={x,y} -> arr[0]=x, arr[1] = y
                break;
            
            case $this::DIRECTION_EAST:
                $this->position[0] += 1;
                break;
            
            case $this::DIRECTION_SOUTH:
                $this->position[1] -= 1;
                break;
            
            case $this::DIRECTION_WEST:
                $this->position[0] -= 1;
                break;
            
            default:
                break;
        }
        return $this; // for method chaining
    }

    public function instructions($command)
    {
        for ($i=0;$i<strlen($command);$i++){
            switch ($command[$i]){
                case 'R':
                    $this->turnRight();
                    break;
                case 'L':
                    $this->turnLeft();
                    break;
                case 'A':
                    $this->advance();
                    break;
                default:
                    throw new InvalidArgumentException("[x] Invalid instruction $command[$i] given. It must be a char from the following list: ['R', 'L', 'A'].");
                    break;
            }
        }
    }
}

function display_arr($arr){
    for ($i=0;$i<count($arr);$i++){
        echo "$arr[$i]";
    }
}

function where_is($person){
    echo "Steve is facing $person->direction at "; 
    display_arr($person->position);
    echo " <br>";
}

$steve = new Robot([0,0],Robot::DIRECTION_NORTH);
where_is($steve);

// turn right
$steve->turnRight();
echo "Steve turned right.<br>";
where_is($steve);

$steve->turnRight();
echo "Steve turned right, again.<br>";
where_is($steve);

$steve->turnRight();
echo "Yet again, Steve turned right.<br>";
where_is($steve);

$steve->turnRight();
echo "For the last time, Steve turned right.<br>";
where_is($steve);

// turn left
$steve->turnLeft();
echo "Steve turned left.<br>";
where_is($steve);

$steve->turnLeft();
echo "Steve turned left, again.<br>";
where_is($steve);

$steve->turnLeft();
echo "Yet again, Steve turned left.<br>";
where_is($steve);

$steve->turnLeft();
echo "'This is the Last time.', Steve said calmly and turned left.<br>";
where_is($steve);


// advance (go straight)
$steve->advance();
echo "Steve walked straight.<br>";
where_is($steve);

$steve->advance();
echo "Steve walked straight .<br>";
where_is($steve);

// test instructions

?>
    </body>
</html>