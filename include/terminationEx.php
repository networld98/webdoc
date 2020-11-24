<?php
function getTerminationEx ($num)
{

    //Оставляем две последние цифры от $num
    $number = substr($num, -2);

    //Если 2 последние цифры входят в диапазон от 11 до 14
    //Тогда подставляем окончание "ЕВ"
    if($number > 10 and $number < 15)
    {
        $term = "ов";
    }
    else
    {

        $number = substr($number, -1);

        if($number == 0) {$term = "ов";}
        if($number == 1 ) {$term = "а";}
        if($number > 1 ) {$term = "ов";}
    }

    echo  $num.' отзыв'.$term;
}
?>