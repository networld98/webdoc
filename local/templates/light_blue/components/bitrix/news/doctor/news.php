<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?
global $Filter;
if($_COOKIE['bxmaker_geoip_2_4_2_city']==NULL){
    $_COOKIE['bxmaker_geoip_2_4_2_city'] = $_COOKIE[bxmaker_geoip_2_4_2_city];
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
$Filter = array("PROPERTY_CITY" => $cityId);?>
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
        "FILTER_NAME" => 'Filter',
        "FILTER_VIEW_MODE" => "vertical",
        "HIDE_NOT_AVAILABLE" => "N",
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PAGER_PARAMS_NAME" => "arrPager",
        "PREFILTER_NAME" => "",
        "SAVE_IN_SESSION" => "N",
        "SECTION_CODE" => "",
        "SECTION_DESCRIPTION" => "-",
        "SECTION_ID" => "",
        "SECTION_TITLE" => "-",
        "SEF_MODE" => "N",
        "TEMPLATE_THEME" => "blue",
        "XML_EXPORT" => "N",
        "POPUP_POSITION" => "left",
        "NOT_FILTER" => "N"
    ),
    false
);
?>
<section class="container">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );?>
    <?if (isset($_GET["sort"]) && isset($_GET["order"]) && (
            $_GET["sort"] == "show_counter" ||
            $_GET["sort"] == "property_SECT_RATING" ||
            $_GET["sort"] == "property_STANDING" ||
            $_GET["sort"] == "property_PRICE" ||
            $_GET["sort"] == "property_REVIEWS" ||
            $_GET["sort"] == "property_SPECIALIZATION_MAIN")){
        global $sort, $order;
        $sort = $_GET["sort"];
        $order = $_GET["order"];
    }else{
        $sort = "property_SECT_RATING";
        $order = "desc";
    }
    ?>
</section>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
        "SORT_BY1" => $sort,
        "SORT_ORDER1" => $order,
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
        "FILTER_NAME" => 'Filter',
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
	),
	$component
);?>
<?/*<section class="container doctors-lastfeedback">
    <h2 class="title-h2">Аллергологи - последние отзывы</h2>
    <div class="doctors-lastfeedback-list slick-slider1">
        <div class="doctors-lastfeedback-list-item">
            <div class="doctors-lastfeedback-list-item__doctor-info">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                <div class="doctors-lastfeedback-list-item__doctor-info__content">
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                </div>
            </div>
            <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
            <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
        </div>
        <div class="doctors-lastfeedback-list-item">
            <div class="doctors-lastfeedback-list-item__doctor-info">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                <div class="doctors-lastfeedback-list-item__doctor-info__content">
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                </div>
            </div>
            <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
            <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
        </div>
        <div class="doctors-lastfeedback-list-item">
            <div class="doctors-lastfeedback-list-item__doctor-info">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                <div class="doctors-lastfeedback-list-item__doctor-info__content">
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                </div>
            </div>
            <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
            <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
        </div>
        <div class="doctors-lastfeedback-list-item">
            <div class="doctors-lastfeedback-list-item__doctor-info">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                <div class="doctors-lastfeedback-list-item__doctor-info__content">
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                </div>
            </div>
            <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
            <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
        </div>
        <div class="doctors-lastfeedback-list-item">
            <div class="doctors-lastfeedback-list-item__doctor-info">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
                <div class="doctors-lastfeedback-list-item__doctor-info__content">
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
                    <p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
                </div>
            </div>
            <p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
            <p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
        </div>
    </div>
</section>*/?>
