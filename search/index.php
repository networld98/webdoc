<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<section class="clinic-card">
    <? $APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "search_filter", Array(
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_TYPE" => "N",	// Тип кеширования
        "COMPONENT_TEMPLATE" => "custom",
        "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
        "DISPLAY_ELEMENT_COUNT" => "N",	// Показывать количество
        "FILTER_NAME" => 'arrFilter',	// Имя выходящего массива для фильтрации
        "FILTER_VIEW_MODE" => "vertical",
        "HIDE_NOT_AVAILABLE" => "N",	// Не отображать недоступные товары
        "IBLOCK_TYPE" => "content",	// Тип инфоблока
        "IBLOCK_ID" => "9",	// Инфоблок
        "PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок в постраничной навигации
        "PREFILTER_NAME" => "",	// Имя входящего массива для дополнительной фильтрации элементов
        "SAVE_IN_SESSION" => "N",	// Сохранять установки фильтра в сессии пользователя
        "SECTION_CODE" => "",	// Код раздела
        "SECTION_DESCRIPTION" => "-",	// Описание
        "SECTION_ID" => "",	// ID раздела инфоблока
        "SECTION_TITLE" => "-",	// Заголовок
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "TEMPLATE_THEME" => "blue",	// Цветовая тема
        "XML_EXPORT" => "N",	// Включить поддержку Яндекс Островов
        "POPUP_POSITION" => "left",
        "NOT_FILTER" => "N"
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
	"custom", 
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
		"USE_LANGUAGE_GUESS" => "Y",
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
		"CACHE_TYPE" => "A",
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