<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиники");
?>
<section class="clinic-card">
       <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"clinic", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "clinic",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CITY",
			17 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",

		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CITY",
			17 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/clinics/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "SPECIALIZATION",
			1 => "ADDRESS",
			2 => "DOCTORS",
			3 => "WORK_TIME",
			4 => "DEPARTURE_HOUSE",
			5 => "CHILDREN_DOCTOR",
			6 => "DIAGNOSTICS",
			7 => "CONTACTS",
			8 => "MAP",
			9 => "AREA",
			10 => "ONLINE",
			11 => "COST_PRICE",
			12 => "DMC",
			13 => "UMC",
			14 => "REGION",
			15 => "METRO",
			16 => "CATEGORY",
			17 => "RATING",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
    </section>
    <?if($APPLICATION->GetCurPage() == '/clinics/') {?>
    <section class="container specializations">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/specialization.php"
            ),
            false
        ); ?>
    </section>
    <?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>