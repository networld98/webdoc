<?
$timeForm = [];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$week = array('Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' );
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>10, "ID"=>$_POST['doctor']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){
    $arProps = $ob->GetProperties();
}
foreach($arProps["RECEPTION_SCHEDULE"]["VALUE"] as $key => $item){
    $str = explode('/',$item);;
    if( $str[2] == $_POST['id'] && $str[0] == $_POST['day'] ){
        $timeForm[] = $str[1];
    }
}
foreach ($timeForm as $item){?>
    <option value="<?=$item?>"><?=$item?></option>
<?}?>
<script>
    $(document).ready(function () {
            let date = $('#selectDay').val();
            let time = $('#selectTime').val();
            $('#fullTime').val(date + '/' + time );
    });
</script>
