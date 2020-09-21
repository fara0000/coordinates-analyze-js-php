<?php 
    session_start();
    if ( !isset($_SESSION["history"]) ) {
        $_SESSION["history"] = array();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="root">
        <header>
            <p>
                <strong>Л/Р №1 по Веб-программированию</strong>
            </p>
            <p>
                <strong>Фахри Иманзаде Рашид оглы</strong>
            </p>
            <p>
                <strong>P3212 Вариант: 211010</strong>
            </p>
        </header>
        <div id="img">
            <img src="img/Screenshot_1.png">
        </div>
            <form id="form" name="form" action="index.php" method="GET">
                <p>Выберите X:</p>
                <div class="form__container" id="x-buttons-wrapper">
                    <button type="button" class="x-button" id="x_-4" onclick="changeX('-4')">-4</button>
                    <button type="button" class="x-button" id="x_-3" onclick="changeX('-3')">-3</button>
                    <button type="button" class="x-button" id="x_-2" onclick="changeX('-2')">-2</button>
                    <button type="button" class="x-button" id="x_-1" onclick="changeX('-1')">-1</button>
                    <button type="button" class="x-button" id="x_0" onclick="changeX('0')">0</button>
                    <button type="button" class="x-button" id="x_1" onclick="changeX('1')">1</button>
                    <button type="button" class="x-button" id="x_2" onclick="changeX('2')">2</button>
                    <button type="button" class="x-button" id="x_3" onclick="changeX('3')">3</button>
                    <button type="button" class="x-button" id="x_4" onclick="changeX('4')">4</button>
                    <input type = "hidden" name = "X" id = "hidden" value = "">
                </div>
                <p>Выберите Y:</p>
                <div class="form__container" id="form__input__wrapper">
                    <input
                        type="text"
                        maxlength="6"
                        class="y-r-input"
                        id="form__input"
                        placeholder="choose a number between (-3,5)"
                        name = "Y"
                    />
                </div>
                <p>Выберите R:</p>
                <div class="form__container" id="form__select__wrapper">
                    <select class="y-r-input" id="form__selector" onchange="getSelectedValue()">
                        <option value="1" name="R" selected onclick="getSelectedValue(this.value)">1</option>
                        <option value="2" name="R" onclick="getSelectedValue(this.value)">2</option>
                        <option value="3" name="R" onclick="getSelectedValue(this.value)">3</option>
                        <option value="4" name="R" onclick="getSelectedValue(this.value)">4</option>
                        <option value="5" name="R" onclick="getSelectedValue(this.value)">5</option>
                    </select>
                    <input type = "hidden" name = "R" id = "hiddenR" value = "1">
                </div>
                <div class="form__container" id="check__button__wrapper">
                    <input type="submit" id="check__button" value="Проверить!"/>
                </div>
                <p id = "notification" name = "notification"> </p>
            </form>
            <?php
                $duration_start = microtime(true);
                if( isset($_GET["X"]) && isset($_GET["Y"]) && isset($_GET["R"])) {
                    function validate() {
                        // $x = intval($_GET["X"]);
                        // $y = floatval($_GET["Y"]);
                        // $r = intval($_GET["R"]);
                        $is_valid = true;

                        if (!is_numeric($_GET["X"]) || ($_GET["X"] < -4) || ($_GET["X"] > 4)) {
                            echo "<p style=\"font-size: 40px; color: red; font-family: monospace; margin-bottom: 2%;\">Значение X некорректно!</p>";
                            $is_valid = false;
                        }
                        if (!is_numeric($_GET["Y"]) || ($_GET["Y"] <= -3) || ($_GET["Y"] >= 5)) {
                            echo "<p style=\"font-size: 40px; color: red; font-family: monospace; margin-bottom: 2%;\">Значение Y некорректно!</p>";
                            $is_valid = false;
                        }
                        if (!is_numeric($_GET["R"]) || ($_GET["R"] < 1) || ($_GET["R"] > 5)) {
                            echo "<p style=\"font-size: 40px; color: red; font-family: monospace; margin-bottom: 2%;\">Значение R некорректно!</p>";
                            $is_valid = false;
                        }

                        return $is_valid;
                    }

                    if (validate()) {
                        echo "<table>
                        <caption style=\"font-size: 38px; color: #3e3939; font-family: monospace; margin-bottom: 2%;\">Результат Запроса</caption>
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
                        $x = intval($_GET["X"]);
                        $y = floatval($_GET["Y"]);
                        $r = intval($_GET["R"]);

                        echo "<tr>
                        <td>$x</td>
                        <td>$y</td>
                        <td>$r</td>";

                        $extime_end = microtime();
                        $extime = round( ($extime_end - $extime_start) * 1000, 3 );
                        echo "<td>$extime</td>";

                        date_default_timezone_set('Asia/Baku');
                        $date = date("F j, H:i:s");
                        echo "<td>$date</td>";

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
                            $result = "Точка " . ( check_area() ? "" : "не " ) . "входит!";
                                echo "<td>" . $result . "</td></tr>";

                            $unit = [
                                'X' => $x,
                                'Y' => $y,
                                'R' => $r,
                                'result' => $result
                            ];

                            $_SESSION["history"][] = $unit;
                    }

                    echo "</tbody></table>";

                    if ( count($_SESSION["history"]) > 0 ) {
                        echo "<table class=\"label centered\">
                            <caption style=\"font-size: 38px; color: #3e3939; font-family: monospace; margin-bottom: 2%;\">История запросов</caption>
                            <thead><th>X</th><th>Y</th><th>R</th><th>Результат</th></thead><tbody>";
        
                        foreach ($_SESSION["history"] as $unit) {
                            echo "<tr><td>{$unit['X']}</td><td>{$unit['Y']}</td><td>{$unit['R']}</td><td>{$unit['result']}</td></tr>";
                        }
                        echo "</tbody></table>";
                    }
                }
            ?>
           <div id="timezone"></div>
        </div>
    </div>
    <script src="index.js"></script>
</body>
</html>