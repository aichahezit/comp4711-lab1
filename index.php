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
                    
                    // checks for diagonals
                    if (($this->position[2] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)) {
                        $result = true;
                        return $result;
                    }else if (($this->position[0] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[8] == $token)) {
                        $result = true;
                        return $result;
                    }
                    
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
                    return $result;
                }
                
                function display() {
                    echo '<table cols="3" style="fontsize:
                          large; fontweight:
                          bold">';
                    echo '<tr>'; // open the first row
                    for ($pos=0; $pos<9;$pos++) {
                        echo $this->show_cell($pos);
                        if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
                    }
                    echo '</tr>'; // close the last row
                    echo '</table>';
                }
                
                function show_cell($which) {
                    $token = $this->position[$which];
                    // deal with the easy case
                    if ($token <> '')
                    return '<td>'.$token.'</td>';
                    // now the hard case
                    $this->newposition = $this->position; // copy the original
                    $this->newposition[$which] = 'o'; // this would be their move
                    $move = implode($this->newposition); // make a string from the board array
                    $link = '/?board='.$move; // this is what we want the link to be
                    // so return a cell containing an anchor and showing a hyphen
                    return '<td><a href=”'.$link.'”></a></td>';
                }
                
                function pick_move(){
                    echo "moving..";
                    //loop through and find next spot = '-'
                    for($i = 0; $i < sizeof($this->position); $i++){
                        if ($this->position[$i] = '-'){
                            echo $this->position[$i];
                            $this->position[$i] = 'x';
                            echo $this->position[$i];
                            break;
                        }
                    }
                }
            }
            
            $squares = $_GET['board'];
            $game = new Game($squares);
            
            while(1){
            $game->display();
                if ($game->winner('x')){
                    echo 'X wins. Lucky guesses!';
                    break;
                }else if ($game->winner('o')){
                    echo 'O wins. Muahahahaha';
                    break;
                }else{
                    $game->pick_move();
                }
            }
            
        ?>
    </body>
</html>


