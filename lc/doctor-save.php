<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use \CUtilEx as CUtil;
CModule::IncludeModule('iblock');

//Получаем список городов показываемых в фильтре
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
const MY_HL_BLOCK_ID = 2;
CModule::IncludeModule('highloadblock');
function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

//Собираем названия городов
$arSelect = array("ID", "NAME");
$arFilter = array("IBLOCK_ID"=>14);
$obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
while($ar_result = $obSections->GetNext())
{
    $cityName[$ar_result['ID']] = trim($ar_result['NAME'], ".");
}

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
<?
//Получаем список городов показываемых в фильтре
$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
    'order' => array('UF_CITY'=>'ASC'),
    'select' => array('*'),
    'filter' => array('!UF_CITY'=>false)
));
while($el = $rsData->fetch()){
    $cityKey[$el['ID']] = $el['UF_CITY'];
}
foreach($PROPS['CITY'] as $cityDoctor) {
    if (!in_array($cityDoctor, $cityKey)) {
        $entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
        $result = $entity_data_class::add(array(
            'UF_CITY' => $cityDoctor,
            'UF_NAME' => $cityName[$cityDoctor],
        ));
    }
}
?>
    <span style="color:green">Данные сохранены</span>
<?}?>