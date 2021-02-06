<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?>
<?
$curPagePath = $APPLICATION->GetCurDir();
$curPagePath = explode("/", $curPagePath);
console_log($_GET['view']);
function services_list($iblock){
    $services = [];
    $arSelect = array("NAME","ID");
    $arFilter = array("IBLOCK_ID"=>$iblock);
    $obSections = CIBlockSection::GetList(array("NAME" => "ASC"), $arFilter, false, $arSelect);
    while($ar_result = $obSections->GetNext()) {
        $arSelect = array("NAME", "DETAIL_PAGE_URL");
        $arFilter = array("IBLOCK_ID" => $iblock, "SECTION_ID" => $ar_result['ID']);
        $res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arItem = $ob->GetFields();
            $services[$ar_result['NAME']][] = array("NAME" => $arItem['NAME'], "URL" => $arItem['DETAIL_PAGE_URL']);
        }
    }?>
    <?foreach ($services as $key=> $service){?>
        <div class="services-list-item">
            <h3 class="title-h3"><?=$key?><span class="services-list-item__count"><?=count($service)?></span></h3>
            <ul class="services-list-item__list">
                <?foreach ($service as $item){?>
                    <li><a href="<?=$item['URL']?>"><?=$item['NAME']?></a></li>
                <?}?>
        </div>
    <?}
}
?>
<div class="full-screen__filter-bg services-filter">
    <section class="container">
    <? $APPLICATION->IncludeComponent(
        "webnauts:catalog.smart.filter",
        "search_filter",
        array(
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPONENT_TEMPLATE" => "search_filter",
            "CONVERT_CURRENCY" => "N",
            "DISPLAY_ELEMENT_COUNT" => "N",
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "FILTER_VIEW_MODE" => "vertical",
            "HIDE_NOT_AVAILABLE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "9",
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
    </section>
</div>
<section class="container">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );?>
</section>
<section class="container services-list services-detail">
    <?if($curPagePath[2]==NULL){?>
        <h2 class="title-h2">Услуги по направлениям</h2>
        <div class="sort-block">
            <ul class="nav nav-tabs sort-block-list" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="sort-block-list-item <?if($_GET['view'] == 'serv') echo 'active'?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="<?if($_GET['view'] == 'serv'){echo 'true';} else echo 'false';?>">Направления</a>
                </li>
                <li class="nav-item">
                    <a class="sort-block-list-item <?if($_GET['view'] == 'diag') echo 'active'?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="<?if($_GET['view'] == 'diag'){echo 'true';} else echo 'false';?>">Диагностика</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?if($_GET['view'] == 'serv') echo ' show active'?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                <? services_list(19)?>
                </div>
            <div class="tab-pane fade <?if($_GET['view'] == 'diag') echo 'show active'?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <? services_list(18)?>
            </div>
        </div>
    <?}else{?>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"services", 
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
		"COMPONENT_TEMPLATE" => "services",
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
			0 => "",
			1 => "SPECIALIZATION",
			2 => "ADDRESS",
			3 => "DOCTORS",
			4 => "WORK_TIME",
			5 => "DEPARTURE_HOUSE",
			6 => "CHILDREN_DOCTOR",
			7 => "DIAGNOSTICS",
			8 => "CONTACTS",
			9 => "MAP",
			10 => "AREA",
			11 => "ONLINE",
			12 => "COST_PRICE",
			13 => "DMC",
			14 => "UMC",
			15 => "REGION",
			16 => "METRO",
			17 => "CITY",
			18 => "",
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
			0 => "",
			1 => "SPECIALIZATION",
			2 => "ADDRESS",
			3 => "DOCTORS",
			4 => "WORK_TIME",
			5 => "DEPARTURE_HOUSE",
			6 => "CHILDREN_DOCTOR",
			7 => "DIAGNOSTICS",
			8 => "CONTACTS",
			9 => "MAP",
			10 => "AREA",
			11 => "ONLINE",
			12 => "COST_PRICE",
			13 => "DMC",
			14 => "UMC",
			15 => "REGION",
			16 => "METRO",
			17 => "CITY",
			18 => "",
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
		"SEF_FOLDER" => "/services/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => "",
		"FILTER_PROPERTY_CODE" => "",
		"IBLOCK_ID" => "19",
		"FILE_404" => "",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"detail" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		)
	),
	false
);?>
    <?}?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>