<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = [9,10];
$start = strtotime(date('d.m.Y'));
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array('ID', 'NAME'));
    while ($ob = $res->GetNextElement()) {
        $Element = $ob->GetFields();
        $PROP[127] = 128;
        $PROP[125] = 89;
        CIBlockElement::SetPropertyValuesEx($Element['ID'], false, $PROP);
    }
}
print "Отработал";
?>