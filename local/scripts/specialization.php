<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*$iblock = 9;
use \Bitrix\Main\Loader;
if(CModule::IncludeModule('iblock')) {
    $el = new CIBlockElement;
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, array(), Array('ID','TIMESTAMP_X'));
    while ($ob = $res->GetNextElement()) {
        $Element = $ob->GetFields();
            $el = new CIBlockElement;
            $el->Update($Element['ID'], Array('TIMESTAMP_X' => true, "MODIFIED_BY" => $USER->GetID()));
    }
}*/
print "Отработал";
?>