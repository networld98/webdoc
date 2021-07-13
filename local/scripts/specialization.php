<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 9;
use \Bitrix\Main\Loader;
if(CModule::IncludeModule('iblock')) {
    $el = new CIBlockElement;
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, array("nTopCount" => 1500), Array());
    while ($ob = $res->GetNextElement()) {
        $specClinicNames = [];
        $Element = $ob->GetFields();
        $Prop = $ob->GetProperties();
        if ($Prop['SPECIALIZATION']['VALUE'][0] != NULL) {
            foreach ($Prop['SPECIALIZATION']['VALUE'] as $spec) {
                $obElement = CIBlockElement::GetByID($spec);
                if ($arEl = $obElement->GetNext())
                    $specClinicNames[] = $arEl["NAME"];
            }
        }
        $specClinicNamesText = implode(", ", $specClinicNames);
            CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText));
            $el->Update($Element['ID'], Array('TIMESTAMP_X' => true));
            \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($iblock, $Element['ID']);
            $f = fopen('specialization.log', 'a');
            fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописалить специализации\n");
            fclose($f);
    }
}
print "Отработал";
?>