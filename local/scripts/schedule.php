<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 9;
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array('ID', 'NAME', 'PROPERTY_WORK_TIME'));
    while ($ob = $res->GetNextElement()) {
        $Element = $ob->GetFields();
        $schedule = explode(';',$Element['PROPERTY_WORK_TIME_VALUE']);
        if(count($schedule) != 8){
            CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("WORK_TIME" => 'Пн/07/00/20/00;Вт/07/00/20/00;Ср/07/00/20/00;Чт/07/00/20/00;Пт/07/00/20/00;Сб/07/00/20/00;Вс/07/00/20/00;'));

            $f = fopen('schedule.log', 'a');
            fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописан график работы\n");
            fclose($f);
        }
    }
}
print "Отработал";
?>