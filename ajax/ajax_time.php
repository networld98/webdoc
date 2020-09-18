<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$arSelect = Array();//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>10, "ID"=>$_POST['doctor']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
}
foreach ($arProps["RECEPTION_SCHEDULE"]["VALUE"] as $item){
    $date = explode('/',$item);
    $res = CIBlockElement::GetByID($date[2]);
    if($ar_res = $res->GetNext())
        $times[] = ["TIME" =>$date[1], "DAY" =>$date[0],"CLINIC" =>$ar_res['NAME']];
}
usort($times, function($a, $b){
    return ($a['TIME'] - $b['TIME']);
});
foreach ($times as $item){
    if($item['DAY'] == $_POST['day'] ){?>
        <li class="choosing-time__worktimming-list-item popup-reception-click" title="<?=$item['CLINIC']?>">
            <a href="<?=$arFields['DETAIL_PAGE_URL']?>?clinic=<?=$item['CLINIC']?>&time=<?=$item['DAY']?> <?=$item['TIME']?>"><?=$item['TIME']?></a>
        </li>
    <?}
}?>