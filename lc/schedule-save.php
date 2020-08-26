<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$PROPS = [];
foreach ($_POST as $key => $data){
    $PROPS[$key] = $data;
    if ($data['DAY_AND_NIGHT'] == NULL ) {
        if (count($data) == 4 && is_array($data) && $key != "FULL_PROPERTY" ){
            $str[] = $key.'/'.$data[0].'/'.$data[1].'/'.$data[2].'/'.$data[3].';';
        }elseif(is_array($data) && $key != "FULL_PROPERTY"){
            $str[] = $key.'/Выходной;';
        }
        $PROPS['WORK_TIME'] = implode($str);
    }else {
        $PROPS['WORK_TIME'] = "Круглосуточно";

    }
}
foreach ($_POST['FULL_PROPERTY'] as $data){
    if (!array_key_exists($data,$_POST)){
        $PROPS[$data] = NULL;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    CModule::IncludeModule("iblock");
    CIBlockElement::SetPropertyValuesEx($_POST['ID_CLINIC'], false, $PROPS);
    ?>
    <span style="color:green">Данные сохранены</span>
<?}?>