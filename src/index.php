<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <?
       if( isset($_GET["X"]) && isset($_GET["Y"]) && isset($_GET["R"])) {
           echo "<table>
           <thead>
               <tr>
                   <th>X</th>
                   <th>Y</th>
                   <th>R</th>
                   <th>Script duration</th>
                   <th>Date</th>
                   <th>Result</th>
               </tr>
            </thead>
            <tbody>";

            $extime_start = microtime();
            $x = htmlspecialchars($_GET["X"]);
            $y = htmlspecialchars($_GET["Y"]);
            $r = htmlspecialchars($_GET["R"]);

            echo "<tr>
            <td>$x</td>
            <td>$y</td>
            <td>$r</td>";

            function validate() {
                global $x, $y, $r;
                $is_valid = true;

                if (filter_var($x, FILTER_VALIDATE_INT) === false || (+$x < -4) || (+$x > 4)) {
                    echo "<tr><td colspan=\"2\">Значение X некорректно!</td></tr>";
                    $is_valid = false;
                }
                if (filter_var($y, FILTER_VALIDATE_FLOAT) === false || (+$y <= -3) || (+$y >= 5)) {
                    echo "<tr><td colspan=\"2\">Значение Y некорректно!</td></tr>";
                    $is_valid = false;
                }
                if (filter_var($r, FILTER_VALIDATE_INT) === false || (+$r < 1) || (+$r > 5)) {
                    echo "<tr><td colspan=\"2\">Значение R некорректно!</td></tr>";
                    $is_valid = false;
                }

                return $is_valid;
            }

            function check_area() {
                global $x, $y, $r;
                if ($x >= 0) {
                    if ($y >= 0) {
                        return ($x <= $r) && ($y <= $r);
                    }
                    return ($x ** 2 + $y ** 2) <= ($r ** 2 / 4);
                }
                if ($y < 0) {
                    return false;
                }
                return $y >= ($x - $r / 2);
            }

            if (validate()) {
                echo "<td>Точка " . ( check_area() ? "" : "не " ) . "входит!</td></tr>";
            }
       }
    ?>
</body>
</html>