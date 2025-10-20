<?php
    function hayTriple($arr) {
        for ($i=0; $i < count($arr) - 2 ; $i++) { 
            if ($arr[$i] === $arr[$i + 1] && $arr[$i + 1] === $arr[$i + 2]) {
                return true;
            }
        }
        return false;
    }

    function countries($arr) {
        foreach ($arr as $pais => $capital) {
            echo 'The capital of <strong>' . $pais . '</strong> is <strong>' . $capital . '</strong><br>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>
<body>
    <?php
        $array1 = [1, 1, 2, 2, 1];
        $array2 = [1, 1, 2, 1, 2, 3];
        $array3 = [1, 1, 1, 2, 2, 2, 1];

        echo '<h2>funcion 1</h2>';

        echo 'Input: { 1, 1, 2, 2, 1 } -> ';
        var_export(hayTriple($array1));
        echo '<br>';

        echo 'Input: { 1, 1, 2, 1, 2, 3 } -> ';
        var_export(hayTriple($array2));
        echo '<br>';

        echo 'Input: { 1, 1, 1, 2, 2, 2, 1 } -> ';
        var_export(hayTriple($array3));
        echo '<br>';
        
        echo '<h2>funcion 2</h2>';

        $ceu = array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw");

        countries($ceu);
    ?>
</body>
</html>