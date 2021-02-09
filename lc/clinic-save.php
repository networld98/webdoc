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
    //Если города нет в списке добавляем его
    if (!in_array($PROPS['CITY'],$cityKey)){
        $entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
        $result = $entity_data_class::add(array(
            'UF_CITY'         => $PROPS['CITY'],
            'UF_NAME'         => $cityName[$PROPS['CITY']],
        ));
    }
    ?>
    <span style="color:green">Данные сохранены</span>
<?}?>