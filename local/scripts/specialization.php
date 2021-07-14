<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 9;
use \Bitrix\Main\Loader;
if(CModule::IncludeModule('iblock')) {
    $el = new CIBlockElement;
    $arFilter = Array("IBLOCK_ID" => $iblock,"INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, array(), Array('PROPERTY_SPECIALIZATION_TECHNICAL_FIELD','NAME', 'ID', 'PROPERTY_SPECIALIZATION'));
    while ($ob = $res->GetNextElement()) {
        $Element = $ob->GetFields();
        if ($Element['PROPERTY_SPECIALIZATION_VALUE']!= NULL) {
            $obElement = CIBlockElement::GetByID($Element['PROPERTY_SPECIALIZATION_VALUE']);
            if ($arEl = $obElement->GetNext())
                $specClinicNames[$Element['ID']][] = $arEl["NAME"];
        }
    }
    foreach ($specClinicNames as $key => $item){
        $specClinicNamesText = implode(", ", $item);
        echo $specClinicNamesText.'<br>';
        CIBlockElement::SetPropertyValuesEx($key, false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText));
        $el->Update($key, Array('TIMESTAMP_X' => true, "MODIFIED_BY" => $USER->GetID()));
        $f = fopen('specialization.log', 'a');
        fwrite($f, date('d.m.Y H:i:s') . " Клинике " . $Element['NAME'] . " Прописалить специализации\n");
        fclose($f);
    }
}
print "Отработал";
?>