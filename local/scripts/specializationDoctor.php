<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 10;
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array());
    while ($ob = $res->GetNextElement()) {
        $specClinicNames = [];
        $Element = $ob->GetFields();
        $Prop = $ob->GetProperties();
        if ($Prop['SPECIALIZATION_MAIN']['VALUE']!= NULL) {
            $obElement = CIBlockSection::GetByID($Prop['SPECIALIZATION_MAIN']['VALUE']);
            if ($arEl = $obElement->GetNext())
                $specClinicNames[] = $arEl["NAME"];
        }
        if ($Prop['SPECIALIZATION_DOP']['VALUE']!= NULL) {
            $obElement = CIBlockSection::GetByID($Prop['SPECIALIZATION_DOP']['VALUE']);
            if ($arEl = $obElement->GetNext())
                $specClinicNames[] = $arEl["NAME"];
        }
        if ($Prop['SPECIALIZATIONS']['VALUE'][0] != NULL) {
            foreach ($Prop['SPECIALIZATIONS']['VALUE'] as $spec) {
                $obElement = CIBlockElement::GetByID($spec);
                if ($arEl = $obElement->GetNext())
                    $specClinicNames[] = $arEl["NAME"];
            }
        }
            $specClinicNamesText = implode(" ", $specClinicNames);
            CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText));
            $f = fopen('specializationDoctor.log', 'a');
            fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописалить специализации\n");
            fclose($f);
    }
}
print "Отработал";
?>