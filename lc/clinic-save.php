<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    if (strpos($key, 'METRO') !== false) {
        $PROPS['METRO'][] = $data;
    } elseif (strpos($key, 'SPECIALIZATION') !== false) {
        $PROPS['SPECIALIZATION'][] = $data;
    } elseif (strpos($key, 'CONTACTS') !== false) {
        $PROPS['CONTACTS'][] = $data;
    }else{
        $PROPS[$key] = $data;
    }
    if ($PROPS['METRO'] == NULL) {
        $PROPS['METRO'] = NULL;
    }
}
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
        $nameClinic = $obEl->Update($_POST['ID_CLINIC'],array('NAME' => $_POST['NAME_CLINIC'], 'CODE' => $trans, 'DETAIL_TEXT' => $_POST['DETAIL_TEXT']));
    ?>
    <span style="color:green">Данные сохранены</span>

<?}?>