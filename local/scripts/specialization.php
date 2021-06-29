<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 9;
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, array(), Array());
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
        $specClinicNamesText = implode(" ", $specClinicNames);
        $countInText =  str_word_count($Prop['SPECIALIZATION_TECHNICAL_FIELD']['VALUE']['TEXT'], 0, "АаБбВвГгҐґДдЕеЁёЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЪъЫыЮюЬьЭэЯя" );
        $countInSpec = str_word_count($specClinicNamesText, 0, "АаБбВвГгҐґДдЕеЁёЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЪъЫыЮюЬьЭэЯя" );
        if ($countInText != $countInSpec) {
            CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText));
            $f = fopen('specialization.log', 'a');
            fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописалить специализации\n");
            fclose($f);
        }
    }
}
print "Отработал";
?>