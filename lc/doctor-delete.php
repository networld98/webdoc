<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
function doctorInClinic($id, $param)
{
    CModule::IncludeModule('iblock');
    $arFilter = Array("IBLOCK_ID" => $id, $param);
    $arSelect = Array();
    $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $props = $ob->GetProperties();
        return $props;
    }
    return false;
}
$clinics = doctorInClinic(10, array("ID"=> $_POST['ID_DOCTOR']));
if(in_array($_POST['ID_CLINIC'],$clinics['CLINIK']['VALUE'])){
    $delClinics = array_diff($clinics['CLINIK']['VALUE'],[$_POST['ID_CLINIC']]);
    if(count($delClinics) == 0){
        $delClinics = NULL;
    }
    CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, array("CLINIK" => $delClinics));
    echo '<span style="color:green">Доктор был откреплен от вашей клинике, вы можете добавить его снова, добавив его номер телефона</span>';
}
?>