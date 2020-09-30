<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    if ($data[3] == 'on' && $data[4]!=NULL){
        $PROPS[$_POST['PROPS']][] = $data[0].'/'.$data[2].'/'.$data[4].'/'.$data[1];
    }else{
        $PROPS[$_POST['PROPS']][] = NULL;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    CIBlockElement::SetPropertyValuesEx($_POST['ID_CLINIC'], false, $PROPS);
    ?>
    <span style="color:green">Данные сохранены</span>
<?}?>