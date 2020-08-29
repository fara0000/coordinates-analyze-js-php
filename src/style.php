<!DOCTYPE HTML>

<html>

<head>

<meta charset="utf-8">

<link rel="shortcut icon" href="favicon.ico">

<title>WEB - Лабораторная#1</title>

<style>

table {width: 50%; border: 3px solid black; margin-bottom: 10px;}

.header {font: 20pt serif; margin-bottom: 10px;}

.centered {text-align: center; margin-left: auto; margin-right: auto;}

.label {font: 16pt monospace;}

.button {width: 100%; background-color: transparent; font: 14pt monospace; color: black;}

.button:hover {background-color: #ADD}

.selected {color: red; font-weight: bolder;}

#ytext {width: 80%; font: 14pt monospace; color: black; text-align: center;}

#rselector {width: 80%; background-color: transparent; font: 14pt monospace; color: black;}

</style>

<script src="jquery-3.4.1.min.js"></script>

<script>

$(document).ready(function() {

$(".X").click(function() {

$(".X").removeClass("selected");

$(this).addClass("selected");

$("#xfield").val( $(this).val() );

});

$("#main-form").on("submit", function() {

let text = $("#ytext").val().substr(0, 16)

if (text === "" || isNaN(text) || +text <= -3 || +text >= 5) {

$("#message").html("Введите корректное значение Y.");

return false;

}

return true;

});

$("#timer").html( new Date().toLocaleString() );

setInterval(() => {

$("#timer").html( new Date().toLocaleString());

}, 1000);

});

</script>

</head>

<body>

<div class="header centered">

Иманзаде Фахри группа P3211<br>

Вариант 211010

</div>

<div class="centered"><img src="areas.png"></div>

<form method="GET" id="main-form">

<table class="centered">

<tr><td colspan="3"><div class="label">X:</div></td></tr>

<tr>

<td><input type="button" class="X button" value="-4"></td>

<td><input type="button" class="X button" value="-3"></td>

<td><input type="button" class="X button" value="-2"></td>

</tr>

<tr>

<td><input type="button" class="X button" value="-1"></td>

<td><input type="button" class="X button selected" value="0"></td>

<td><input type="button" class="X button" value="1"></td>

</tr>

<tr>

<td><input type="button" class="X button" value="2"></td>

<td><input type="button" class="X button" value="3"></td>

<td><input type="button" class="X button" value="4"></td>

</tr>

<tr><td colspan="3">

<div class="label">Y:</div>

<input type="text" id="ytext" name="Y" autocomplete="off" placeholder="(-3; 5)">

</td></tr>

<tr><td colspan="3" id="message" class="label"></td></tr>

<tr><td colspan="3">

<div class="label">R:</div>

<select name="R" id="rselector">

<option selected value="1">1</option>

<option value="2">2</option>

<option value="3">3</option>

<option value="4">4</option>

<option value="5">5</option>

</select>

</td></tr>

<tr><td colspan="3"><input type="submit" value="Вычислить" class="button"></td></tr>

</table>

<input type="hidden" name="X" value="0" id="xfield">

</form>

<?php
    if ( isset($_GET["X"]) && isset($_GET["Y"]) && isset($_GET["R"]) ) {

        echo "<table class=\"label centered\"><thead><th>Переменная</th><th>Значение</th></thead><tbody>";

        $extime_start = microtime();

        $x = htmlspecialchars($_GET["X"]);
        $y = htmlspecialchars($_GET["Y"]);
        $r = htmlspecialchars($_GET["R"]);

        echo "<tr><td>X</td><td>$x</td></tr>
        <tr><td>Y</td><td>$y</td></tr>
        <tr><td>R</td><td>$r</td></tr>";

        $x = substr($x, 0, 16);
        $y = substr($y, 0, 16);
        $r = substr($r, 0, 16);

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
            echo "<tr><td>Результат</td><td>Точка " . ( check_area() ? "" : "не " ) . "входит!</td></tr>";
        }
        
        $extime_end = microtime();
        $extime = round( ($extime_end - $extime_start) * 1000, 3 );
        echo "<tr><td colspan=\"2\">Время выполнения скрипта: $extime мс";
        echo "</tbody></table>";
    }
?>

<div id="timer" class="label centered"></div>
</body>
</html>