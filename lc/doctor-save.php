<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
if($_POST['ID_CLINIC']!=NULL){
    $SCHEDULE = $_POST['ID_CLINIC'];
}else{
    $SCHEDULE = $_POST['ID_DOCTOR'];
}
foreach ($_POST as $key => $data){
    if (strpos($key, 'SPECIALIZATIONS') !== false) {
        $PROPS['SPECIALIZATIONS'] = $data;
    }elseif (strpos($key, 'RECEPTION_SCHEDULE') !== false && $data[0]!=NULL && $data[1]==NULL ) {
        $PROPS['RECEPTION_SCHEDULE'][] = $data[0];
    }elseif (strpos($key, 'RECEPTION_SCHEDULE') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        $PROPS['RECEPTION_SCHEDULE'][] = $data[0].'/'.$data[1].'/'.$SCHEDULE;
    }
    elseif (strpos($key, 'EXPERIENCE') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        if (is_array($data)) {
            $PROPS['EXPERIENCE'][] = $data[0].'/'.$data[1];
        }
    } elseif (strpos($key, 'EDUCATION') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        if (is_array($data)) {
            $PROPS['EDUCATION'][] = $data[0].'/'.$data[1];
        }
    } elseif (strpos($key, 'ADDRESSES') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        if (is_array($data)) {
            $city = explode('/', $data[0]);
            $PROPS['RECEPTION_ADDRESSES'][] = $city[1].'/'.$data[1];
            $PROPS['CITY'][] = $city[0];
        }
    } else {
        $PROPS[$key] = $data;
    }
}
foreach ($_POST['FULL_PROPERTY'] as $data) {
    if (!array_key_exists($data, $_POST)) {
        $PROPS[$data] = NULL;
    }
}
if(empty($_POST['PHOTO'])){
    $PROPS[141] = 107;
}else{
    $PROPS[141] = NULL;
};
if ($PROPS['EXPERIENCE'] == NULL) {
    $PROPS['EXPERIENCE'] = NULL;
}
if ($PROPS['EDUCATION'] == NULL) {
    $PROPS['EDUCATION'] = NULL;
}
$PROPS['RECEPTION_SCHEDULE'] = array_unique($PROPS['RECEPTION_SCHEDULE']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $trans = Cutil::translit($_POST['NAME_DOCTOR'],"ru",$arParams);
        CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, $PROPS);
        $nameClinic = $obEl->Update($_POST['ID_DOCTOR'],array('NAME' => $_POST['NAME_DOCTOR'], 'CODE' => $trans, 'DETAIL_TEXT' => $_POST['DETAIL_TEXT'], 'PREVIEW_TEXT' => $_POST['PREVIEW_TEXT'], "DETAIL_PICTURE" => CFile::MakeFileArray($_POST['PHOTO'])));
    unlink($_POST['PHOTO']);
?>
    <span style="color:green">Данные сохранены</span>
<?}?>