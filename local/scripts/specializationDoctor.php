<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$iblock = 10;
if(CModule::IncludeModule('iblock')) {
    $arFilter = Array("IBLOCK_ID" => $iblock, "PROPERTY_SPECIALIZATION_TECHNICAL_FIELD_VALUE" => false);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array());
    while ($ob = $res->GetNextElement()) {
        $specClinicNames = [];
        $doctorAddress = [];
        $doctorArea= [];
        $specClinic = [];
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
        foreach ($doctorAddress as $key => $item) {
            if(count($item)!=3){
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
           $specClinicNamesText = implode(" ", $specClinicNames);
           CIBlockElement::SetPropertyValuesEx($Element['ID'], false, array("SPECIALIZATION_TECHNICAL_FIELD" => $specClinicNamesText, "SPECIALIZATION_FULL" => $specClinic, "RECEPTION_ADDRESSES" => $doctorFullAddress));
    }
}
print "Отработал";
?>