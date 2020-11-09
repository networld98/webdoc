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
        if($props['CLINIK']['VALUE']==NULL){

        }
        return $props;
    }
    return false;
}
$clinics = doctorInClinic(10, array("ID"=> $_POST['ID_DOCTOR']));

if($clinics['CLINIK']['VALUE']==NULL){
    $clinics['CLINIK']['VALUE'] = 0;
}
    if($_POST['DELETE']){
        $delMessage = array_diff($clinics['MESSAGE']['VALUE'],[$_POST['ID_CLINIC']]);
        if(count($delMessage) == 0){
            $delMessage = NULL;
        }
         CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, array("MESSAGE" => $delMessage));
        echo '<span style="color:red">&nbsp;Вы отклонили приглашение</span>';
    }else{
        if(!in_array($_POST['ID_CLINIC'],$clinics['CLINIK']['VALUE'])){

            $addClinics[] = array_push($clinics['CLINIK']['VALUE'],$_POST['ID_CLINIC']);
            $delMessage = array_diff($clinics['MESSAGE']['VALUE'],[$_POST['ID_CLINIC']]);
            if(count($delMessage) == 0){
                $delMessage = NULL;
            }
            CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, array("CLINIK" => $clinics['CLINIK']['VALUE'], "MESSAGE" => $delMessage));
            echo '<span style="color:green">&nbsp;Вы приняли приглашение</span>';
        }
    }
?>