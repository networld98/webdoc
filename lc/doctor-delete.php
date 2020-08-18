<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
function searchDoctor($id, $param)
{
    CModule::IncludeModule('iblock');
    $arFilter = Array("IBLOCK_ID" => $id, $param);

    $arSelect = Array('ID',);
    $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $idDoctor = $arFields;
        return $idDoctor;
    }
    return false;
}
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
echo"<pre>";
print_r($_POST);
echo"</pre>";
$phoneDoctor = searchDoctor(10, array("PROPERTY_TECH_PHONE"=> $_POST['PHONE']));
$clinics = doctorInClinic(10, array("PROPERTY_TECH_PHONE"=> $_POST['PHONE']));
if($_POST['PHONE']!=NULL){
    if ($phoneDoctor['ID']!=NULL){
        if(!in_array($_POST['ID_CLINIC'],$clinics['CLINIK']['VALUE'])){
            $addClinics[] = array_push($clinics['CLINIK']['VALUE'],$_POST['ID_CLINIC']);
            CIBlockElement::SetPropertyValuesEx($phoneDoctor['ID'], false, array("CLINIK" => $clinics['CLINIK']['VALUE']));
            echo '<span style="color:green">Врач, с таким номером, существовал и привязан к вашей клинике, редактирование будет доступно после перезагрузки страницы</span>';
        }else{
            echo '<span style="color:red">Врач, с таким номером, уже привязан к вашей клинике</span>';
        }
    }elseif ($phoneDoctor==NULL && $_POST['NAME_DOCTOR']!=NULL){

        $el = new CIBlockElement;
        $PROP = array();
        $PROP[74] = $_POST['ID_CLINIC'];
        $PROP[139] = 98;
        $PROP[148] = $_POST['PHONE'];
        $arParams = array("replace_space"=>"-","replace_other"=>"-");
        $trans = Cutil::translit($_POST['NAME_DOCTOR'],"ru",$arParams);
        $arLoadProductArray = Array(
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => 10,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $_POST['NAME_DOCTOR'],
            "CODE" => substr($_POST['PHONE'], -4).'_'.$trans,
            "ACTIVE" => "Y",
            "DETAIL_PICTURE" => $_POST['DETAIL_PICTURE']
        );
        $PRODUCT_ID = $el->Add($arLoadProductArray);
        echo '<span style="color:green">Врач создан и добавлен в вашу клинику, редактирование будет доступно после перезагрузки страницы</span>';
    }else{
        echo '<span style="color:red">Не введено ФИО врача, без него врач не будет создан</span>';
    }

}else{
    echo '<span style="color:red">Не введен номер телефона для привязки, без него врач не будет создан</span>';
};
?>