<?
if ('cli' ==  php_sapi_name()){
    $_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/ext_www/webdoc.clinic';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
//Собираем названия городов
$arSelect = array("ID", "NAME");
$arFilter = array("IBLOCK_ID"=>14);
$obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
while($ar_result = $obSections->GetNext())
{
    $cityName[$ar_result['ID']] = trim($ar_result['NAME'], ".");
}

//Подключаем список городо которые выводим в списке
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
const MY_HL_BLOCK_ID = 2;
CModule::IncludeModule('highloadblock');
//Функция получения экземпляра класса:
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
$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
    'order' => array('UF_CITY'=>'ASC'),
    'select' => array('*'),
    'filter' => array('!UF_CITY'=>false)
));
while($el = $rsData->fetch()){
    $cityKey[$el['ID']] = $el['UF_CITY'];
}

$iblock = [9,10];

$arFilter = Array("IBLOCK_ID" => $iblock, "INCLUDE_SUBSECTIONS" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), Array('ID', 'NAME', 'PROPERTY_CITY'));
while ($ob = $res->GetNextElement()) {
    $Element = $ob->GetFields();
    if($Element['PROPERTY_CITY_VALUE']!=NULL && !in_array($Element['PROPERTY_CITY_VALUE'],$cityArray) && is_numeric($Element['PROPERTY_CITY_VALUE'])){
        $cityArray[] = $Element['PROPERTY_CITY_VALUE'];
    }
}

foreach($cityArray as $city) {
    if (!in_array($city,$cityKey)){
        $entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
        $result = $entity_data_class::add(array(
            'UF_CITY'         => $city,
            'UF_NAME'         => trim($cityName[$city]),
        ));
    }
}
foreach($cityKey as $key => $cityHLBT) {
    if(!in_array($cityHLBT,$cityArray)){
        $entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
        $result = $entity_data_class::delete($key);
    }
}
$f = fopen($_SERVER["DOCUMENT_ROOT"].'/local/scripts/city_in_filter.log', 'a');
fwrite($f, date('d.m.Y H:i:s') . " скрипт выполнился\n");
fclose($f);
print "Отработал";
?>