<?php
    /*
    $array = ['name', 'age', 'sex'];
    if (empty($array)) {
        echo 'this array is empty';
    } else {
        echo 'this array is not empty';
    }
    
    $age = 21;
    if ($age <= 21) {
        echo 'the age of user is not greater than 21 years old';    
    } else {
        echo 'the age of user is greater than 21 years old';
    }
    
    $month = 1;
    while ($month <= 12) {
        echo "$month, ";
        $month++;
    }
    
    for ($i = 1; $i <= 10; $i++) {
        echo "$i, ";
    }
    
    $number = 43;
    if ($number < 10) {
        echo 'the number is less than 10';
    } elseif ($number < 20) {
        echo 'the number is less than 20';
    } elseif ($number < 30) {
        echo 'the number is less than 30';
    } else {
        echo 'the number is greater than or equal to 30';
    }
    */
    $day = "wed";
    switch ($day) {
        case "mon" :
            echo "Monday";
            break;
        case "tue" :
            echo "Tuesday";
            break;
        case "wed" :
            echo "Wednesday";
            break;
        case "thu" :
            echo "Thursday";
            break;
        case "fri" :
            echo "Friday";
            break;
        case "sat" :
            echo "Saturday";
            break;
        case "sun" :
            echo "Sunday";
            break;
        default :
            echo "no matched day";
    }
?>