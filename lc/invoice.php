<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
use \CUtilEx as CUtil;
//Инфоблок со счетами
$iblock = 24;
CModule::IncludeModule('iblock');
$date = date("d.m.Y");
$year = date("Y");
$str = explode('/',$_POST['NAME_PRICE']);
$itemName = $str[0];
$itemPrice = $str[1];
$itemId = $str[2];
$cnt = 0;
$res = CIBlockElement::GetList(
    array("SORT"=>"ID"),
    array('IBLOCK_ID' => $iblock),
    false,
    false,
    array('PROPERTY_NUMBER')
);
while($ob = $res->GetNextElement()){
    $cnt++;
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    if($arFields['PROPERTY_NUMBER_VALUE'] && $arFields['PROPERTY_NUMBER_VALUE'] > $number){
        $number = $arFields['PROPERTY_NUMBER_VALUE'];
    }

}
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
        * {
            font-family: arial;
            font-size: 14px;
            line-height: 14px;
        }
        table.border, table.border tr, table.border td {
            border: 1px solid #000;
        }
        table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        table td {
            padding: 5px;
        }
        table th {
            padding: 5px;
            font-weight: bold;
        }

        .header {
            margin: 0 0 0 0;
            padding: 0 0 15px 0;
            font-size: 12px;
            line-height: 12px;
        }

        /* Реквизиты банка */
        .details td {
            padding: 3px 2px;
            border: 1px solid #000000;
            font-size: 12px;
            line-height: 12px;
            vertical-align: top;
        }

         h2 {
            margin: 0 0 10px 0;
            padding: 10px 0 10px 0;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        /* Поставщик/Покупатель */
        .contract th {
            padding: 3px 0;
            vertical-align: top;
            text-align: left;
            font-size: 13px;
            line-height: 15px;
        }
        .contract td {
            padding: 3px 0;
        }

        /* Наименование товара, работ, услуг */
        .list thead, .list tbody  {
            border: 2px solid #000;
        }
        .list thead th {
            padding: 4px 0;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
        }
        .list tbody td {
            padding: 0 2px;
            border: 1px solid #000;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
        }
        .list tfoot th {
            padding: 3px 2px;
            border: none;
            text-align: right;
        }

        /* Сумма */
        .total {
            margin: 0 0 20px 0;
            padding: 0 0 10px 0;
            border-bottom: 2px solid #000;
        }
        .total p {
            margin: 0;
            padding: 0;
        }

        /* Руководитель, бухгалтер */
        .sign {
            position: relative;
        }

        .signature {
            width: 200px;
            position: absolute;
            top: 10%;
            left: 80%;
        }
        .printing {
            position: absolute;
            left: 150px;
            top: -15px;
            width: 245px;
        }
        @media (max-width: 576px) {
            #invoice .tinkoff-btn {
                margin: 0;
            }
            #invoice form {
            width: 100%;
            }
            #invoice .invoice-link {
            width: 100%;
            text-align: center;
            }
            #invoice {
            padding-bottom: 24px;
            }
        }
    </style>
</head>
<body>
<table class="header media-print-desktop">
        <tbody><tr>
            <td>
                <b>ООО "НОВОБИТ"</b>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="border media-print-desktop" width="100%">
        <colgroup>
            <col width="29%">
            <col width="29%">
            <col width="10%">
            <col width="32%">
        </colgroup>
        <tbody><tr>
            <td>ИНН 5040166146</td>
            <td>КПП 504001001</td>
            <td rowspan="2">
                <br>
                <br>
                Сч. №
            </td>
            <td rowspan="2">
                <br>
                <br>
                40702810010000659531
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Получатель<br>
                ООО "НОВОБИТ"
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Банк получателя<br>
                АО «Тинькофф Банк» Москва, 123060, 1-й Волоколамский проезд, д. 10, стр. 1			</td>
            <td>
                БИК<br>
                Сч. №<br>
            </td>
            <td>
                044525974<br>
            </td>
        </tr>
        </tbody></table>
    <br>
    <br>
        <h2 class="media-print-desktop"> Счёт № '.$cnt.'/'.$year.' от '.$date.'	 </h2>
    <br>
    <table width="100%" class="media-print-desktop">
        <tbody>
        <tr>
            <td style="width:100%;">Плательщик:<br>'.$_POST["CLIENT"].'</td>
        </tr>
        </tbody>
    </table>
    <table class="border media-print-desktop" width="100%">
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
                '.$itemName.'</td>
            <td align="right">
                1
            </td>
            <td align="right">
                год
            </td>
            <td align="right">
                <nobr>'.$itemPrice.'</nobr>
            </td>
            <td align="right">
                <nobr>'.$itemPrice.'</nobr>
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
                <nobr>'.$itemPrice.'</nobr>
            </td>
        </tr>

        </tbody></table>
    <br><span class="media-print-desktop">Всего наименований 1, на сумму '.$itemPrice.' руб.</span><br><br>
    <b class="media-print-desktop">'.num2str($itemPrice).'</b>
    <br>
    <br>
    <div class="sign media-print-desktop">
        <br>
        <br>
        <br>
        <br>
		<img class="printing" src="'.$_SERVER["DOCUMENT_ROOT"].'/local/seal.png">
        <table class="media-print-desktop">
            <colgroup>
                <col width="25%">
                <col width="50%">
                <col width="25%">
            </colgroup>
            <tbody>
            <tr>
                <td>Генеральный директор</td>
                 <td style=" border: 1pt solid #000000; border-width: 0pt 0pt 1pt 0pt; text-align: center; "><img class="signature" src="'.$_SERVER["DOCUMENT_ROOT"].'/local/signature.png"></td>
                <td style="text-align:right">
                    (Белов Дмитрий Олегович)
                </td>
            </tr>
            </tbody>
        </table>
	</div>
</body>
</html>';
use Dompdf\Dompdf;
include_once $_SERVER["DOCUMENT_ROOT"].'/local/dompdf/autoload.inc.php';
$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdf = $dompdf->output();
$arParams = array("replace_space"=>"-","replace_other"=>"-");
$trans = Cutil::translit("Счёт № '".$cnt."/".$year." от ".$date,"ru",$arParams);

$linkFile = '/upload/invoces/'.$trans.'.pdf';
file_put_contents($_SERVER["DOCUMENT_ROOT"]. $linkFile, $pdf);
$el = new CIBlockElement;
$PROP = array();
$PROP[165] = 'https://doctora.clinic'.$linkFile;
$PROP[166] = $_POST["NAME"];
$PROP[167] = $cnt;
$PROP[169] = $itemPrice;
$PROP[170] = $itemName;
$arLoadProductArray = Array(
    "MODIFIED_BY" => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID" => $iblock,
    "PROPERTY_VALUES" => $PROP,
    "NAME" => "Счёт № ".$cnt."/".$year." от ".$date,
    "CODE" => $trans,
    "ACTIVE" => "Y",
);
$PRODUCT_ID = $el->Add($arLoadProductArray);
?>
<a target="_blank" href="<?=$linkFile?>" class="save invoice-link">Скачать счёт</a>
<script src="https://securepay.tinkoff.ru/html/payForm/js/tinkoff_v2.js"></script>
<button class="tinkoff-btn" id="tinkoff-btn">Оплатить картой</button>
<script>
    $(document).ready(function () {
        $("#tinkoff-btn").click(function () {
            location.href = '/lc/pay/?Id=<?=$PRODUCT_ID?>&OrderId=<?=$cnt?>&Description=<?=$itemName?>&Price=<?=$itemPrice?>&Email=<?=$_POST["EMAIL"]?>&Phone=<?=$_POST["LOGIN"]?>&ServiceId=<?=$itemId?>';
        });
    });
</script>
<?echo $html;
?>
