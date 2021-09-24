<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<?
global $smartPreFilter;
if($_COOKIE['bxmaker_geoip_2_4_2_city'] == NULL){
    $_COOKIE['bxmaker_geoip_2_4_2_city'] = $_COOKIE[bxmaker_geoip_2_4_2_city];
}
if($_COOKIE['bxmaker_geoip_2_4_2_region'] == NULL){
    $_COOKIE['bxmaker_geoip_2_4_2_region'] = $_COOKIE[bxmaker_geoip_2_4_2_region];
}
\Bitrix\Main\Loader::includeModule('iblock');
$rsSection = \Bitrix\Iblock\SectionTable::getList(array(
    'filter' => array(
        'IBLOCK_ID' => 14,
        'NAME' => $_COOKIE['bxmaker_geoip_2_4_2_city'],
    ),
    'select' =>  array('ID'),
));
while ($arSection=$rsSection->fetch())
{
    $cityId = $arSection['ID'];
}
$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
    'filter' => array(
        'IBLOCK_ID' => 27,
        'NAME' => $_COOKIE['bxmaker_geoip_2_4_2_region'],
    ),
    'select' =>  array('ID'),
));
while ($arElement=$dbItems->fetch())
{
    $regionId = $arElement['ID'];
}

$smartPreFilter = array("PROPERTY_CITY" => $cityId, "PROPERTY_REGION" => $regionId);?>
<section class="clinic-card">
    <? $APPLICATION->IncludeComponent(
	"webnauts:catalog.smart.filter",
	"search_filter_area_metro",
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "search_filter_area_metro",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_ELEMENT_COUNT" => "N",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "vertical",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "9,10,18,19,20,21,22",
		"PAGER_PARAMS_NAME" => "arrPager",
        "PREFILTER_NAME" => "smartPreFilter",
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "N",
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N",
		"POPUP_POSITION" => "left",
		"NOT_FILTER" => "N",
		"SEF_RULE" => "#SMART_FILTER_PATH#",
		"SECTION_CODE_PATH" => "",
		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"]
	),
	false
);
    ?>
</section>
<section class="container about-page">
    <?$APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "custom",
        Array(
            "PATH" => "",
            "SITE_ID" => "s1",
            "START_FROM" => "0"
        )
    );?>
    <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
    <?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"custom_v3",
	array(
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "30",
		"TAGS_URL_SEARCH" => "/search/index.php",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"USE_SUGGEST" => "Y",
		"SHOW_RATING" => "Y",
		"PATH_TO_USER_PROFILE" => "",
		"AJAX_MODE" => "N",
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "N",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "Y",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "arrFilter",
		"arrFILTER" => array(
			0 => "iblock_content",
		),
		"SHOW_WHERE" => "Y",
		"arrWHERE" => array(
			0 => "iblock_content",
		),
		"SHOW_WHEN" => "Y",
		"PAGE_RESULT_COUNT" => "300",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "show_more",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "custom",
		"arrFILTER_iblock_content" => array(
			0 => "9",
			1 => "10",
			2 => "18",
			3 => "19",
            4 => "20",
            5 => "21",
            6 => "22",
		),
		"SHOW_ITEM_TAGS" => "Y",
		"SHOW_ITEM_DATE_CHANGE" => "Y",
		"SHOW_ORDER_BY" => "Y",
		"SHOW_TAGS_CLOUD" => "N",
		"RATING_TYPE" => ""
	),
	false
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>