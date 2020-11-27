<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    if (strpos($key, 'METRO') !== false) {
        $PROPS['METRO'][] = $data;
    } elseif (strpos($key, 'SPECIALIZATION') !== false) {
        $PROPS['SPECIALIZATION'][] = explode('/', $data)[0];
        $specialization_technical_text[] = explode('/', $data)[1];
    } elseif (strpos($key, 'DAY_RECEPTION') !== false) {
    $PROPS['DAY_RECEPTION'][] = $data;
    } elseif (strpos($key, 'CONTACTS') !== false) {
        $PROPS['CONTACTS'][] = $data;
    }else{
        $PROPS[$key] = $data;
    }
    if ($PROPS['METRO'] == NULL) {
        $PROPS['METRO'] = NULL;
    }
    if ($PROPS['DAY_RECEPTION'] == NULL) {
        $PROPS['DAY_RECEPTION'] = NULL;
    }
    if ($PROPS['LOGO'] != NULL) {
        $PROPS['LOGO'] = CFile::MakeFileArray(str_replace($_SERVER["DOCUMENT_ROOT"], $_SERVER['HTTP_ORIGIN'], $_POST['LOGO']));
    }
}
$PROPS['COST_PRICE'] = $_POST['COST_PRICE'];
$PROPS['MAIN_SPECIALIZATION'] = $_POST['MAIN_SPECIALIZATION'];
$PROPS['SPECIALIZATION_TECHNICAL_FIELD'] = implode(" ", $specialization_technical_text);
foreach ($_POST['FULL_PROPERTY'] as $data){
    if (!array_key_exists($data,$_POST)){
        $PROPS[$data] = NULL;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $trans = Cutil::translit($_POST['NAME_CLINIC'],"ru",$arParams);
        CIBlockElement::SetPropertyValuesEx($_POST['ID_CLINIC'], false, $PROPS);
        $nameClinic = $obEl->Update($_POST['ID_CLINIC'],array('NAME' => $_POST['NAME_CLINIC'], 'CODE' => $trans, 'PREVIEW_TEXT' => $_POST['PREVIEW_TEXT'], 'DETAIL_TEXT' => $_POST['DETAIL_TEXT']));
    unlink($_POST['LOGO']);
    ?>
    <span style="color:green">Данные сохранены</span>

<?}?>