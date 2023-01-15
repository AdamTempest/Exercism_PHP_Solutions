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

            for($i=0;$i<5;$i++){
                $table.=$result[$i];
            }
        }

        public function get_finalResult($results){
            $table = "Team                           | MP |  W |  D |  L |  P";

            foreach($results as $team=>$result){
                // writeToTable($table,$team,result);
            }

            return $table;
        }

        public function give_points($current_match,$result){
            switch ($current_match[2]){
                case "win":
                    $result[$current_match[0]][1] += 1; // 1st team's win   += 1
                    $result[$current_match[0]][4] += 3; // 1st team's point += 3
                    $result[$current_match[1]][3] += 1; // 2nd team's loss  += 1
                case "draw":
                    $result[$current_match[0]][2] += 1; // 1st team's draw  += 1
                    $result[$current_match[0]][4] += 1; // 1st team's point += 1
                    $result[$current_match[1]][2] += 1; // 2nd team's draw  += 1
                    $result[$current_match[1]][4] += 1; // 2nd team's point += 1
                case "loss":
                    $result[$current_match[0]][3] += 1; // 1st team's loss  += 1
                    $result[$current_match[1]][1] += 1; // 2nd team's win   += 1
                    $result[$current_match[1]][4] += 3; // 2nd team's point += 3
            }
            return $result;
        }

        public function tally($scores){
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

                    // create table and write it to final result
                    return $this->get_finalResult($result);
                }
            } else { 
                $current_match = explode(";",$scores);
                $result[$current_match[0]] = [1,0,0,0,0]; // [matches played, win, draw, lost, point]
                $result[$current_match[1]] = [1,0,0,0,0]; // [matches played, win, draw, lost, point]
                $result = $this->give_points($current_match,$result);
            }
            
            print_r($current_match);
        }
    }

    // test cases
    $bob = new Tournament();
    $bob->tally("Allegoric Alaskans;Blithering Badgers;win");
    $bob->tally("Allegoric Alaskans;Blithering Badgers;loss");
    $bob->tally("Allegoric Alaskans;Blithering Badgers;draw");
    $bob->tally(
    "Allegoric Alaskans;Blithering Badgers;loss\n" .
    "Allegoric Alaskans;Blithering Badgers;win");

    ?>
    </body>
</html>