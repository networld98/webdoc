<?
if($arParams['IBLOCK_ID'] == 4) {
    rsort($arResult['PROPERTIES']['ACTION_YEAR']['FIELDS']);

    if (!$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ACTION_YEAR']) {
        $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ACTION_YEAR'] = $arResult['PROPERTIES']['ACTION_YEAR']['FIELDS'][0]['VALUE'];
        $arResult['PROPERTIES']['ACTION_YEAR']['FIELDS'][0]['CHECKED'] = 'Y';
    }
    if (!$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ATT_ACTIVE_ACTION_VALUE'] && $_REQUEST['ajax'] != 'Y') {
        $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ATT_ACTIVE_ACTION_VALUE'] = $arResult['PROPERTIES']['ATT_ACTIVE_ACTION']['FIELDS'][0]['VALUE'];
        $arResult['PROPERTIES']['ATT_ACTIVE_ACTION']['FIELDS'][0]['CHECKED'] = 'Y';
    }
}
if($arParams['IBLOCK_ID'] == 6) {
    if (!$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ATT_YEAR_VALUE']) {
        $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_ATT_YEAR_VALUE'] = $arResult['PROPERTIES']['ATT_YEAR']['FIELDS'][0]['VALUE'];
        $arResult['PROPERTIES']['ATT_YEAR']['FIELDS'][0]['CHECKED'] = 'Y';
    }
}
if($arParams['IBLOCK_ID'] == 27) {
    $arResult['PROPERTIES']['YEAR']['FIELDS'] = array_reverse($arResult['PROPERTIES']['YEAR']['FIELDS']);

    if (!$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_YEAR']) {
        $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_YEAR'] = $arResult['PROPERTIES']['YEAR']['FIELDS'][0]['VALUE'];
    }
}
?>
