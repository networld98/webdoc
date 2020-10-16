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
$phoneDoctor = searchDoctor(10, array("PROPERTY_TECH_PHONE"=> $_POST['PHONE']));
$clinics = doctorInClinic(10, array("PROPERTY_TECH_PHONE"=> $_POST['PHONE']));
if($_POST['PHONE']!=NULL){
    if ($phoneDoctor['ID']!=NULL){
        if(!in_array($_POST['ID_CLINIC'],$clinics['CLINIK']['VALUE'])){
            if(count(count($clinics['MESSAGE']['VALUE'][0])==0)){
                $clinics['MESSAGE']['VALUE'] = $_POST['ID_CLINIC'];
            }
            $addClinics[] = array_push($clinics['MESSAGE']['VALUE'],$_POST['ID_CLINIC']);
            CIBlockElement::SetPropertyValuesEx($phoneDoctor['ID'], false, array("MESSAGE" => $clinics['MESSAGE']['VALUE']));
            echo '<span style="color:green">Врач, с таким номером, существовал. Запрос на привязку к вашей клинике отправлен в личный кабинет врача.</span>';
        }else{
            echo '<span style="color:red">Врач, с таким номером, уже привязан к вашей клинике</span>';
        }
    }elseif ($phoneDoctor==NULL && $_POST['NAME_DOCTOR']!=NULL){
        $el = new CIBlockElement;
        $PROP = array();
        if(empty($_POST['PHOTO'])){
            $PROP[141] = 107;
        }
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
            "DETAIL_PICTURE" => CFile::MakeFileArray($_POST['PHOTO'])
        );
        $PRODUCT_ID = $el->Add($arLoadProductArray);
        unlink($_POST['PHOTO']);
        echo '<span style="color:green">Врач создан и добавлен в вашу клинику, редактирование будет доступно после перезагрузки страницы</span>';
    }else{
        echo '<span style="color:red">Не введено ФИО врача, без него врач не будет создан</span>';
    }

}else{
    echo '<span style="color:red">Не введен номер телефона для привязки, без него врач не будет создан</span>';
};
?>