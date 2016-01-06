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
            
            $position = $_GET['board'];
            $squares = str_split($position);
            
            function winner($token,$position) {
                // !!game logic errors!!
                for($row=0; $row<3; $row++) {
                    $result = true;
                    for($col=0; $col<3; $col++){
                        if ($position[3*$row+$col] != $token) $result = false; // note the negative test
                    }
                }
                // checks for diagonals
                if (($position[2] == $token) &&
                ($position[4] == $token) &&
                ($position[6] == $token)) {
                    $result = true;
                }else if (($position[0] == $token) &&
                ($position[3] == $token) &&
                ($position[6] == $token)) {
                    $result = true;
                }
                return $result;
            }
            
            if (winner('x',$squares)) echo 'X wins.';
            else if (winner('o',$squares)) echo 'Y wins.';
            else echo 'No winner yet.';
        ?>
    </body>
</html>


