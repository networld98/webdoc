<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 9;
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, Array());
    while ($ob = $res->GetNextElement()) {
        $specClinicNames = [];
        $Element = $ob->GetFields();
        $Prop = $ob->GetProperties();
        if ($Prop['SPECIALIZATION']['VALUE'][0] != 0) {
            foreach ($Prop['SPECIALIZATION']['VALUE'] as $spec) {
                $obElement = CIBlockElement::GetByID($spec);
                if ($arEl = $obElement->GetNext())
                    $specClinicNames[] = $arEl["NAME"];
            }
        }
        if ($Prop['SPECIALIZATION_TECHNICAL_FIELD']['VALUE']==NULL) {
            $specClinicNamesText = implode(" ", $specClinicNames);
            CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText));

            $f = fopen('specialization.log', 'a');
            fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописалить специализации\n");
            fclose($f);
        }
    }
}
print "Отработал";
?>