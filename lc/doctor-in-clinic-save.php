<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    $PROPS[$key] = $data;
}
foreach ($_POST['FULL_PROPERTY'] as $data) {
    if (!array_key_exists($data, $_POST)) {
        $PROPS[$data] = NULL;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    $obEl = new CIBlockElement();
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $trans = Cutil::translit($_POST['NAME_DOCTOR'],"ru",$arParams);
        CIBlockElement::SetPropertyValuesEx($_POST['ID_DOCTOR'], false, $PROPS);
        $nameClinic = $obEl->Update($_POST['ID_DOCTOR'],array('NAME' => $_POST['NAME_DOCTOR'], 'CODE' => $trans, 'DETAIL_TEXT' => $_POST['DETAIL_TEXT']));
    echo"<pre>";
    print_r($PROPS);
    echo"</pre>";
    ?>
Данные сохранены

<?}?>