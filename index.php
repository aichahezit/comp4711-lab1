<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset-UTF-8">
        <title></title>
    </head>
    <body>
        <?php
      
            if (!isset($_GET['board'])){
                die("Enter board parameters!");
            }
        
            class Game{
                var $position;
                
                function __construct($squares) {
                    $this->position = str_split($squares);
                }
                
                //this doesn't work..........
                function winner($token){
                     // !!game logic errors, doesn't check vertically
                    for($row=0; $row<3; $row++) {
                        $result = true;
                        for($col=0; $col<3; $col++){
                            if ($this->position[3*$row+$col] != $token) $result = false; // note the negative test
                        }
                        if ($result){
                            return $result;
                        }
                    }
                    
                    for($col=0; $col<3; $col++) {
                        $result = true;
                        for($row=0; $row<3; $row++){
                            if ($this->position[3*$col+$row] != $token) $result = false; // note the negative test
                        }
                        if ($result){
                            return $result;
                        }
                    }
                 
                    // checks for diagonals
                    if (($this->position[2] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)) {
                        $result = true;
                    }else if (($this->position[0] == $token) &&
                    ($this->position[3] == $token) &&
                    ($this->position[6] == $token)) {
                        $result = true;
                    }
                    return $result;
                }
            }
            
            $squares = $_GET['board'];
            $game = new Game($squares);
            if ($game->winner('x'))
            echo 'X wins. Lucky guesses!';
            else if ($game->winner('o'))
            echo 'Y wins. Muahahahaha';
            else
            echo 'No winner yet, but you are losing.';
            
        ?>
    </body>
</html>


