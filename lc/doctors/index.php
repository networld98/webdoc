<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

CModule::IncludeModule('iblock');
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
if($arUser['UF_TYPE_USER']!=6) {
    header('Location: http://webdoc.clinic/lc/');
    exit;
}
global $idClinic;
global $cityClinic;
$arFilter = Array("IBLOCK_ID"=>"9", "PROPERTY_PHONE"=> $arUser['LOGIN']);
$arSelect = Array("ID","PROPERTY_CITY","PROPERTY_ADDRESS");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $idClinic = $arFields['ID'];
    $cityClinic = $arFields['PROPERTY_CITY_VALUE'];
    $addressClinic = $arFields['PROPERTY_ADDRESS_VALUE'];
}
?>

<? include '../menu.php';?>
<?if($idClinic !=NULL){?>
    <div class="personal-cabinet-content__doctors-page">
        <h1 class="title-h2"><?$APPLICATION->ShowTitle()?></h1>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"doctor_in_clinic_cabinet", 
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
		"COMPONENT_TEMPLATE" => "doctor_in_clinic_cabinet",
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
			0 => "DEPARTURE_HOUSE",
			1 => "CHILDREN_DOCTOR",
			2 => "DIAGNOSTICS",
			3 => "MAP",
			4 => "ONLINE",
			5 => "DMC",
			6 => "UMC",
			7 => "METRO",
			8 => "SPECIALIZATION",
			9 => "ADDRESS",
			10 => "DOCTORS",
			11 => "WORK_TIME",
			12 => "CONTACTS",
			13 => "AREA",
			14 => "COST_PRICE",
			15 => "REGION",
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
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "DEPARTURE_HOUSE",
			1 => "CHILDREN_DOCTOR",
			2 => "DIAGNOSTICS",
			3 => "RANK",
			4 => "MAP",
			5 => "ONLINE",
			6 => "DMC",
			7 => "UMC",
			8 => "METRO",
			9 => "SPECIALIZATION",
			10 => "ADDRESS",
			11 => "DOCTORS",
			12 => "WORK_TIME",
			13 => "CONTACTS",
			14 => "AREA",
			15 => "COST_PRICE",
			16 => "REGION",
			17 => "CITY",
			18 => "DETAIL_PICTURE",
			19 => "",
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
		"SEF_FOLDER" => "/lc/doctors/",
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
			0 => "DEPARTURE_HOUSE",
			1 => "CHILDREN_DOCTOR",
			2 => "DIAGNOSTICS",
			3 => "CATEGORY",
			4 => "MAP",
			5 => "ONLINE",
			6 => "DMC",
			7 => "UMC",
			8 => "METRO",
			9 => "SPECIALIZATION",
			10 => "ADDRESS",
			11 => "DOCTORS",
			12 => "WORK_TIME",
			13 => "CONTACTS",
			14 => "AREA",
			15 => "COST_PRICE",
			16 => "REGION",
			17 => "CITY",
			18 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
    </div>
<?}else{?>
    <?include '../none-cabinet.php';?>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>