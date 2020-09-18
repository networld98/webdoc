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
    if( $str[2] == $_POST['id'] ){
        $timeForm[$str[0]][] = $str[1];
    }
}
foreach ($week as $day){
    if($timeForm[$day]!=NULL){
        if (is_array($timeForm[$day])) {
            foreach ($timeForm[$day] as $time){
                $sortTimeForm[] = $day.' '.$time;
            }
        }else{
            $sortTimeForm[] = $day.'_'.$timeForm[$day];
        }
    }
}
foreach ($sortTimeForm as $item){?>
    <option data-email="<?=$arUser['EMAIL']?>" data-phone="<?=$arUser['LOGIN']?>" value="<?=$item?>"><?=$item?></option>
<?}?>