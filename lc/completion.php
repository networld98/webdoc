<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
if($number > $cnt){
    $cnt = $number;
}
$cnt = $cnt+1;
function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array(
        array('копейка' , 'копейки',   'копеек',     1),
        array('рубль',    'рубля',     'рублей',     0),
        array('тысяча',   'тысячи',    'тысяч',      1),
        array('миллион',  'миллиона',  'миллионов',  0),
        array('миллиард', 'миллиарда', 'миллиардов', 0),
    );

    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) {
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk - 1;
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; // 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        }
    } else {
        $out[] = $nul;
    }
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}

/**
 * Склоняем словоформу
 * @author runcore
 */
function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}
$html = '
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
       #invoice:not(.print-btn) {
            font-family: arial;
            font-size: 14px;
            line-height: 14px;
        }
        #invoice table.border, #invoice table.border tr, #invoice table.border td {
            border: 1px solid #000;
        }
        #invoice table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        #invoice table td {
            padding: 5px;
        }
        #invoice table th {
            padding: 5px;
            font-weight: bold;
        }

        #invoice .header {
            margin: 0 0 0 0;
            padding: 0 0 15px 0;
            font-size: 12px;
            line-height: 12px;
        }

        /* Реквизиты банка */
        #invoice .details td {
            padding: 3px 2px;
            border: 1px solid #000000;
            font-size: 12px;
            line-height: 12px;
            vertical-align: top;
        }

       #invoice h2 {
            margin: 0 0 10px 0;
            padding: 10px 0 10px 0;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        /* Поставщик/Покупатель */
        #invoice .contract th {
            padding: 3px 0;
            vertical-align: top;
            text-align: left;
            font-size: 13px;
            line-height: 15px;
        }
        #invoice .contract td {
            padding: 3px 0;
        }

        /* Наименование товара, работ, услуг */
        #invoice .list thead, .list tbody  {
            border: 2px solid #000;
        }
        #invoice .list thead th {
            padding: 4px 0;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
        }
        #invoice .list tbody td {
            padding: 0 2px;
            border: 1px solid #000;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
        }
        #invoice .list tfoot th {
            padding: 3px 2px;
            border: none;
            text-align: right;
        }

        /* Сумма */
        #invoice .total {
            margin: 0 0 20px 0;
            padding: 0 0 10px 0;
            border-bottom: 2px solid #000;
        }
        #invoice .total p {
            margin: 0;
            padding: 0;
        }

        /* Руководитель, бухгалтер */
        #invoice .sign {
            position: relative;
        }

        #invoice .signature {
            width: 200px;
            position: absolute;
            top: 10%;
            left: 15%;
        }
        #invoice .printing {
            position: absolute;
            left: 15%;
            top: -15px;
            width: 245px;
        }
    </style>
</head>
<body>
<a href="javascript:(print());" class="print-btn">Распечатать Акт</a>
<div class="media-print-desktop">
        <h2> '.str_replace('Счёт', 'АКТ', $_POST['DOC']).'</h2>
    <br>
    <table width="100%">
        <tbody>
          <tr>
            <td style="width:100%;">Исполнитель: ООО "НОВОБИТ"</td>
        </tr>
        <tr>
            <td style="width:100%;">Заказчик: '.$_POST["NAME"].'</td>
        </tr>
        </tbody>
    </table>
    <table class="border" width="100%">
        <tbody><tr>
            <td>№</td>
            <td>Наименование товара</td>
            <td>Кол-во</td>
            <td>Ед.</td>
            <td>Цена,  руб.</td>
            <td>Сумма,  руб.</td>
        </tr>
        <tr valign="top">
            <td align="center">1</td>
            <td align="left" style="word-break: break-word; word-wrap: break-word; ">
                '.$_POST['OPISANIE'].'</td>
            <td align="right">
                1
            </td>
            <td align="right">
                год
            </td>
            <td align="right">
                <nobr>'.$_POST['SUM'].'</nobr>
            </td>
            <td align="right">
                <nobr>'.$_POST['SUM'].'</nobr>
            </td>
        </tr>
        <tr valign="top">
            <td align="right" style="border-width: 0pt 1pt 0pt 0pt" colspan="5">
                <nobr>НДС:</nobr>
            </td>
            <td align="right">
                <nobr>Без НДС</nobr>
            </td>
        </tr>

        <tr valign="top">
            <td align="right" style="border-width: 0pt 1pt 0pt 0pt" colspan="5">
                <nobr>Итого:</nobr>
            </td>
            <td align="right">
                <nobr>'.$_POST['SUM'].'</nobr>
            </td>
        </tr>

        </tbody></table>
    <br>Всего наименований 1, на сумму '.$_POST['SUM'].' руб.<br><br>
    <b>'.num2str($itemPrice).'</b>
    <br>
    <br>
    <div class="sign">
        <br>
        <br>
        <br>
        <br>
		<img class="printing" src="/local/seal.png">
        <table>
            <colgroup>
                <col width="50%">
                <col width="50%">
            </colgroup>
            <tbody>
            <tr>
                <td>
                    <table>
                      <tr>
                            <td>Исполнитель</td>
                             <td style=" border: 1pt solid #000000; border-width: 0pt 0pt 1pt 0pt; text-align: center; width: 100%;"><img class="signature" src="/local/signature.png"></td>
                        </tr>
                    </table>
                </td>
                <td>
                  <table>
                     <tr>
                        <td>Заказчик</td>
                         <td style=" border: 1pt solid #000000; border-width: 0pt 0pt 1pt 0pt; text-align: center; width: 100%;"></td>
                     </tr>
                  </table>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
	</div>
</div>

</body>
</html>'; ?>
<?echo $html;
?>
