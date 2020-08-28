<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    if (strpos($key, 'SPECIALIZATIONS') !== false) {
        $PROPS['SPECIALIZATIONS'] = $data;
    } elseif (strpos($key, 'RECEPTION_SCHEDULE') !== false) {
        $PROPS['RECEPTION_SCHEDULE'] = $data;
    } elseif (strpos($key, 'DAY_RECEPTION') !== false) {
        $PROPS['DAY_RECEPTION'] = $data;
    } elseif (strpos($key, 'EXPERIENCE') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        if (is_array($data)) {
            $PROPS['EXPERIENCE'][] = $data[0].'/'.$data[1];
        }
    } elseif (strpos($key, 'EDUCATION') !== false && $data[0]!=NULL && $data[1]!=NULL ) {
        if (is_array($data)) {
            $PROPS['EDUCATION'][] = $data[0].'/'.$data[1];
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $trans = Cutil::translit($_POST['NAME_DOCTOR'],"ru",$arParams);
        CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, $PROPS);
        $nameClinic = $obEl->Update($_POST['ID_DOCTOR'],array('NAME' => $_POST['NAME_DOCTOR'], 'CODE' => $trans, 'DETAIL_TEXT' => $_POST['DETAIL_TEXT'], "DETAIL_PICTURE" => CFile::MakeFileArray($_POST['PHOTO'])));
    unlink($_POST['PHOTO']);
?>
    <span style="color:green">Данные сохранены</span>
<?}?>