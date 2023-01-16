<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Tournament</title>
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
    class Tournament
    {
        public function writeToTable($table,$team,$result)
        {
            $table.="\n";
            
            $holder = $team;
            while (strlen($holder)<31){
                $holder.=" ";
            }
            $table.=$holder."|";

            for($i=0;$i<4;$i++){
                $table.="  ".$result[$i]." |";
            }
            $table.="  ".$result[4];
            
            return $table;
        }

        public function get_finalResult($results){
            $table = "Team                           | MP |  W |  D |  L |  P";
            $keys = [];

            // assign keys to keys
            foreach($results as $team=>$result){
                array_push($keys,$team);
            }
            
            // bubble sort it
            $temp = "";
            $size  =count($keys);
            for ($i=0;$i<$size;$i++){
                for ($j=0;$j<$size-$i-1;$j++){
                    if ($results[$keys[$j]][4]>$results[$keys[$j+1]][4]){
                        $temp = $keys[$j+1];
                        $keys[$j+1] = $keys[$j];
                        $keys[$j] = $temp;
                    } else if($results[$keys[$j]][4] == $results[$keys[$j+1]][4]){ // if points are equal sort alphabetically
                        if ($keys[$j] < $keys[$j+1]){
                            $temp = $keys[$j+1];
                            $keys[$j+1] = $keys[$j];
                            $keys[$j] = $temp;
                        }
                    }
                }
            }

            for ($i=$size-1;$i>=0;$i--){
                $table = $this->writeToTable($table,$keys[$i],$results[$keys[$i]]);
            }

            return $table;
        }

        public function give_points($current_match,$result){
            
            switch ($current_match[2]){
                case "win":
                    $result[$current_match[0]][1] += 1; // 1st team's win   += 1
                    $result[$current_match[0]][4] += 3; // 1st team's point += 3
                    $result[$current_match[1]][3] += 1; // 2nd team's loss  += 1
                    break;
                case "draw":
                    $result[$current_match[0]][2] += 1; // 1st team's draw  += 1
                    $result[$current_match[0]][4] += 1; // 1st team's point += 1
                    $result[$current_match[1]][2] += 1; // 2nd team's draw  += 1
                    $result[$current_match[1]][4] += 1; // 2nd team's point += 1
                    break;
                case "loss":
                    $result[$current_match[0]][3] += 1; // 1st team's loss  += 1
                    $result[$current_match[1]][1] += 1; // 2nd team's win   += 1
                    $result[$current_match[1]][4] += 3; // 2nd team's point += 3
                    break;
            }
            
            return $result;
        }

        public function tally($scores){
            if (!(strlen($scores))){ // if it's empty
                return "Team                           | MP |  W |  D |  L |  P";
            }
            $matches = explode("\n",$scores);
            $current_match = [];
            $result = [];
            
            if (count($matches) > 1){ 
                foreach ($matches as $match){
                    $current_match = explode(";", $match); // [1st team, 2nd team, result of the match]

                    // if it's already in array, just add 1 to match played.
                    // else link keys & values into array.
                    for ($i=0;$i<2;$i++){
                        if (array_key_exists($current_match[$i],$result)){
                            $result[$current_match[$i]][0] += 1;
                        } else{
                            $result[$current_match[$i]] = [1,0,0,0,0]; // [matches played, win, draw, loss, point]
                        }
                    }

                    // give points
                    $result = $this->give_points($current_match,$result);
                }
                // create table and write it to final result`
                return $this->get_finalResult($result);
            } else { 
                $current_match = explode(";",$scores);
                $result[$current_match[0]] = [1,0,0,0,0]; // [matches played, win, draw, lost, point]
                $result[$current_match[1]] = [1,0,0,0,0]; // [matches played, win, draw, lost, point]
                $result = $this->give_points($current_match,$result);
                // create table and write it to final result
                return $this->get_finalResult($result);
            }
        }
    }

    // test cases
    $bob = new Tournament();
    
    $res = "";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res = "Allegoric Alaskans;Blithering Badgers;win";
    echo "$res \n". $bob->tally($res) . "\n\n";

    $res = "Allegoric Alaskans;Blithering Badgers;loss";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res = "Allegoric Alaskans;Blithering Badgers;draw";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res = "Allegoric Alaskans;Blithering Badgers;loss\n" .
    "Allegoric Alaskans;Blithering Badgers;win";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res = 
        "Allegoric Alaskans;Blithering Badgers;win\n" .
        "Blithering Badgers;Courageous Californians;win\n" .    
        "Courageous Californians;Allegoric Alaskans;loss";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res = 
    "Allegoric Alaskans;Blithering Badgers;win\n" .
    "Devastating Donkeys;Courageous Californians;draw\n" .
    "Devastating Donkeys;Allegoric Alaskans;win\n" .
    "Courageous Californians;Blithering Badgers;loss\n" .
    "Blithering Badgers;Devastating Donkeys;loss\n" .
    "Allegoric Alaskans;Courageous Californians;win";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res =
    "Allegoric Alaskans;Blithering Badgers;loss\n" .
    "Devastating Donkeys;Allegoric Alaskans;loss\n" .
    "Courageous Californians;Blithering Badgers;draw\n" .
    "Allegoric Alaskans;Courageous Californians;win";
    echo $res ."\n". $bob->tally($res) . "\n\n";

    $res =  
    "Courageous Californians;Devastating Donkeys;win\n" .
    "Allegoric Alaskans;Blithering Badgers;win\n" .
    "Devastating Donkeys;Allegoric Alaskans;loss\n" .
    "Courageous Californians;Blithering Badgers;win\n" .
    "Blithering Badgers;Devastating Donkeys;draw\n" .
    "Allegoric Alaskans;Courageous Californians;draw";
    echo $res ."\n". $bob->tally($res) . "\n\n";



    ?>
    </body>
</html>