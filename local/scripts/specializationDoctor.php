<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 10;
use \Bitrix\Main\Loader;
if(CModule::IncludeModule('iblock')) {
    $el = new CIBlockElement;
    $arFilter = Array("IBLOCK_ID" => $iblock, "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, array("nTopCount" => 1500), Array());
    while ($ob = $res->GetNextElement()) {
        $specClinicNames = [];
        $doctorAddress = [];
        $doctorArea= [];
        $specClinic = [];
        $doctorcity = [];
        $doctorFullAddress = [];
        $Element = $ob->GetFields();
        $Prop = $ob->GetProperties();
        if ($Prop['RECEPTION_ADDRESSES']['VALUE']!= NULL && $Prop['AREA']['VALUE']!= NULL) {
            foreach ($Prop['RECEPTION_ADDRESSES']['VALUE'] as $key => $adr){
                $doctorAddress[] = explode('/', $adr);
            }
            foreach ($Prop['AREA']['VALUE'] as $key => $area){
                $obElement = CIBlockSection::GetByID($area);
                if ($arEl = $obElement->GetNext())
                    $doctorArea[] = $arEl['NAME'];

            }
        }
        if ($Prop['CITY']['VALUE']!= NULL) {
            foreach ($Prop['CITY']['VALUE'] as $key => $city){
                $obElement = CIBlockSection::GetByID($city);
                if ($arEl = $obElement->GetNext())
                    $doctorcity[] = $arEl['NAME'];

            }
        }
        foreach ($doctorAddress as $key => $item) {
            if($item[1]==NULL || $item[1]==''){
                $doctorFullAddress[] = implode('/',array( $doctorcity[$key],$item[0], $doctorArea[$key]));
            }else{
                $doctorFullAddress[] = implode('/',array( $item[0],$item[1], $doctorArea[$key]));
            }
        }
        if ($Prop['SPECIALIZATION_MAIN']['VALUE']!= NULL) {
            $specClinic[] = $Prop['SPECIALIZATION_MAIN']['VALUE'];
            $obElement = CIBlockSection::GetByID($Prop['SPECIALIZATION_MAIN']['VALUE']);
            if ($arEl = $obElement->GetNext())
                $specClinicNames[] = $arEl["NAME"];
        }
        if ($Prop['SPECIALIZATION_DOP']['VALUE']!= NULL) {
            $specClinic[] = $Prop['SPECIALIZATION_DOP']['VALUE'];
            $obElement = CIBlockSection::GetByID($Prop['SPECIALIZATION_DOP']['VALUE']);
            if ($arEl = $obElement->GetNext())
                $specClinicNames[] = $arEl["NAME"];
        }
        if ($Prop['SPECIALIZATIONS']['VALUE'][0] != NULL) {
            $specClinic[] = $Prop['SPECIALIZATION_DOP']['VALUE'];
            foreach ($Prop['SPECIALIZATIONS']['VALUE'] as $spec) {
                $obElement = CIBlockElement::GetByID($spec);
                if ($arEl = $obElement->GetNext())
                    $specClinicNames[] = $arEl["NAME"];
            }
        }
        $specClinicNamesText = implode(", ", $specClinicNames);
        CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText, "SPECIALIZATION_FULL" => $specClinic, "RECEPTION_ADDRESSES" => $doctorFullAddress));
        $el->Update($Element['ID'], Array('TIMESTAMP_X' => true));
        \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($iblock, $Element['ID']);
    }
}
print "Отработал";
?>