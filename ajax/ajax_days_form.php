<?
$timeForm = [];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>10, "ID"=>$_POST['doctor']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){
    $arProps = $ob->GetProperties();
}
$week = array(1=> 'Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' );
$begin = new DateTime( date('Y-m-d') );
if (isset($arProps['PERIOD']['VALUE'])) {
    $end = new DateTime( date('Y-m-d', strtotime('+'.$arProps['PERIOD']['VALUE'].' days')));
}else{
    $end = new DateTime( date('Y-m-d', strtotime('+14 days')));
}
$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($arProps["RECEPTION_SCHEDULE"]["VALUE"] as $key => $item){
    $str = explode('/',$item);;
    if( $str[2] == $_POST['id'] ){
        $timeForm[$str[0]][] = $str[1];
        $dayinClinic[] = $str[0];
    }
}?>
<?foreach($daterange as $date){?>
    <?if (in_array(date( $week[$date->format("N")]),$dayinClinic)){?>
        <option data-id="<?= $_POST['id'] ?>" data-day="<?= date( $week[$date->format("N")]);?>" value="<?= date( $week[$date->format("N")]);?>, <?= date($date->format("d.m.Y"));?>"><?= date( $week[$date->format("N")]);?>, <?= date($date->format("d.m.Y"));?></option>
    <?}?>
<?}?>
<script>
    $(document).ready(function () {
        let date = $('#selectDay').val();
        let time = $('#selectTime').val();
        $('#fullTime').val(date + '/' + time );
    });
</script>