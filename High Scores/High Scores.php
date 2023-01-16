<?php
class HighScores
{
    private $sorted;
    public $scores;
    public $latest;
    public $personalBest;
    public $personalTopThree;

    private function sort($data){
        $sorted = $data;
        $size = count($data);
        for ($i=0;$i<$size;$i++){
            for($j=0;$j<$size-$i-1;$j++){
                if ($sorted[$j]>$sorted[$j+1]){
                    $temp = $sorted[$j];
                    $sorted[$j] = $sorted[$j+1];
                    $sorted[$j+1] = $temp;
                }
            }
        }
        return $sorted;
    }

    private function findBest($data){
        return end($data);
    }

    private function findTopThree($data){
        $topThree=[];

        if (count($data)<=3){
            for ($i=count($data)-1;$i>=0;$i--){
                array_push($topThree,$data[$i]);
            }
        } else{
            for ($i=count($data)-1;$i!=count($data)-4;$i--){
                array_push($topThree,$data[$i]);
            }
        }
        return $topThree;
    }

    public function __construct(array $data)
    {
        $this->scores = $data;
        $this->latest = end($data);
        $this->sorted = $this->sort($data);
        $this->personalBest = $this->findBest($this->sorted);
        $this->personalTopThree = $this->findTopThree($this->sorted);
    }
}
?>