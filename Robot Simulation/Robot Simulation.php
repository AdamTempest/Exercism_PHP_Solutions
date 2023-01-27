<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Robot Simulator</title>
        <style>
            html{
                background-color: black;
            }
            body{
                background-color: #0d1117;
                color: white;
                font-size: 20px;
                margin:50px;
                border: 10px solid gray;
                padding:50px;
                padding-top:0px;
                text-align: center;
                border-radius:100px;
            }

            .error{
                border-left:4px solid #04AA6D;
                align-items: center;
                width:600px;
                font-size:15px;
                font-family:Futura,Helvetica;
                margin: auto;
                margin-top: 10px;
                padding:20px;
                background-color:white;
                color:black;
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
    const DIRECTION_NORTH = "north";
    const DIRECTION_SOUTH = "south";
    const DIRECTION_EAST  = "east";
    const DIRECTION_WEST  = "west";

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

// test cases

function display_arr($arr){
    $len = count($arr);
    echo "[";
    for ($i=0;$i<$len-1;$i++){
        echo $arr[$i],", ";
    }
    echo $arr[$len-1];
    echo "]";
}

function where_is($person,$name){
    echo "$name is facing $person->direction at "; 
    display_arr($person->position);
    echo " <br>";
}

echo "<h1> Test cases </h1>";
$steve = new Robot([0,0],Robot::DIRECTION_NORTH);
where_is($steve, 'Steve');

// turn right
echo "<h2>Test turnRight Method</h2>";
$steve->turnRight();
echo "Steve turned right.<br>";
where_is($steve, 'Steve');

$steve->turnRight();
echo "Steve turned right, again.<br>";
where_is($steve, 'Steve');

$steve->turnRight();
echo "Yet again, Steve turned right.<br>";
where_is($steve, 'Steve');

$steve->turnRight();
echo "For the last time, Steve turned right.<br>";
where_is($steve, 'Steve');

// turn left
echo "<h2>Test turnLeft Method</h2>";
$steve->turnLeft();
echo "Steve turned left.<br>";
where_is($steve, 'Steve');

$steve->turnLeft();
echo "Steve turned left, again.<br>";
where_is($steve, 'Steve');

$steve->turnLeft();
echo "Yet again, Steve turned left.<br>";
where_is($steve, 'Steve');

$steve->turnLeft();
echo "'This is the Last time.', Steve said calmly and turned left.<br>";
where_is($steve, 'Steve');


// advance (go straight)
echo "<h2>Test Advance Method</h2>";
$steve->advance();
echo "Steve walked straight towards $steve->direction.<br>";
where_is($steve, 'Steve');

$steve->advance();
echo "Steve walked straight towards $steve->direction.<br>";
where_is($steve, 'Steve');

/** test instructions **/
echo "<h2>Instruction test</h2>";

// Instructions to move west and north
$robot = new Robot([0, 0], Robot::DIRECTION_NORTH);
$robot->instructions('LAAARALA');
echo "Robot should be on [-4,1] and facing ", Robot::DIRECTION_WEST, "<br>";
where_is($robot,'Robot');

// Instructions to move west and south
$robot = new Robot([2, -7], Robot::DIRECTION_EAST);
$robot->instructions('RRAAAAALA');
echo "Robot should be on [-3, -8] and facing ", Robot::DIRECTION_SOUTH, "<br>";
where_is($robot,'Robot');

// Instructions to move east and north
$robot = new Robot([8, 4], Robot::DIRECTION_SOUTH);
$robot->instructions('LAAARRRALLLL');
echo "Robot should be on [11,5] and facing ", Robot::DIRECTION_NORTH, "<br>";
where_is($robot,'Robot');

/** test Malformed Instruction */
echo "<h2>Testing Malformed Instruction</h2>";
$robot = new Robot([0, 0], Robot::DIRECTION_NORTH);
echo "Instruction LARX was given. <br>";
try{
    $robot->instructions('LARX');
}
catch(\InvalidArgumentException $e){
    echo "Good. Exception was properly thrown out.<br>";
    echo "<div class='error'>";
    echo $e->getMessage();
    echo "</div>";
    
}


/** test method chaining **/
echo "<h2>Method chaining test</h2>";

$robot = new Robot([0, 0], Robot::DIRECTION_NORTH);
$robot->turnLeft()
    ->advance()
    ->advance()
    ->advance()
    ->turnRight()
    ->advance()
    ->turnLeft()
    ->advance();

echo "Robot should be on [-4,1] and facing ", Robot::DIRECTION_WEST, "<br>";
where_is($robot,"Robot");

?>
    </body>
</html>