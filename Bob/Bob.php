<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>Bob</title>
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
    class Bob
    {
        function isThatAQuestion($capital)
        {
            // if it has question mark return true.
            $last = strlen($capital)-1;
            if ($capital[$last] == "?"){
                return true;
            } 
            else if($capital[$last] == " "){
                for($i=$last;$i>0;$i--){
                    if ($capital[$i] == "?"){
                        return true;
                    } else if ($capital[$i] != " "){
                        return false;
                    }
                }
            }
            return false;
        }
        
        function isEmpty($msg){
            $empty_char = 0; $len=strlen($msg);
            for ($i=0;$i<$len;$i++){
                if ($i+1<$len){
                    if($msg[$i].$msg[$i+1]=="\\t"){
                        $empty_char += 2;
                    }
                }
            }
            return $empty_char;
        }
        
        function respondTo($dialogue)
        {
            $length = strlen($dialogue);
            if (!($length)){
                return "Fine. Be that way!";
            }
        
            $yelling = true;
            $empty_char = 0;
            $small_l = 0;
            $capital = 0;
            for ($i=0;$i<$length;$i++){ // findout if it's yelling or not
                $dec = ord($dialogue[$i]);
                $con1 = $dec>=65 && $dec<=90; // is capital letter
                $con2 = $dec>=97 && $dec<=122;// is small letter
                if($con1){ 
                    $capital+=1;
                } else if($con2){
                    $small_l+=1;
                } 
                if($dec==32 || $dec == 9){ // if it's either space or tab
                    $empty_char += 1;
                }
            }
        
            $empty_char += $this->isEmpty($dialogue);
            
            if ($empty_char==$length){
                return "Fine. Be that way!";
            }
            
            // no letter or if there was small letter
            if ((!($small_l) && !($capital)) || $small_l){
                $yelling = false;
            }
        
            $asking = $this->isThatAQuestion($dialogue);
        
            if ($asking && $yelling){
                return "Calm down, I know what I'm doing!";
            } else if ($asking){
                return "Sure.";
            } else if ($yelling){
                return "Whoa, chill out!";
            } else{
                return "Whatever.";
            }
        }
    }
    
    $bob = new Bob();
    while (true){
        $input = readline("Input: ");
        echo "Bob:   ". $bob->respondTo($input)."\n";
    }

    //    public function testOtherWhitespace()
    //    {
    //        $this->assertEquals("Fine. Be that way!", $this->bob->respondTo("\n\r \t\u{000b}\u{00a0}\u{2002}"));
    //    }
    //
    //    public function testShoutingWithUmlauts()
    //    {
    //        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("ÜMLÄÜTS!"));
    //    }
    //
    //    public function testCalmlySpeakingWithUmlauts()
    //    {
    //        $this->assertEquals("Whatever.", $this->bob->respondTo("ÜMLäÜTS!"));
    //    }

    ?>
    </body>
</html>