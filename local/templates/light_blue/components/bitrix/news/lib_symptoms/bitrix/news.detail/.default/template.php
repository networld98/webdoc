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
global $doctorName;
$doctorName = $arResult['NAME'];
?>
<section class="container">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );?>
</section>
<section class="container services-detail">
    <h1 class="title-h2"><?=$APPLICATION->ShowTitle()?></h1>
    <div class="fixed-block-ghost"></div>
    <div class="row">
        <div class="col-lg-3">
            <div class="anchor-block fixed-block">
                <ul class="anchor-block-list">
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="illness-detail-block">
                <?= $arResult["DETAIL_TEXT"];?>
            </div>
            <?
            $arSelect = array("ID", "NAME");
            $arFilter = array("IBLOCK_ID"=>14);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {
                if($ar_result['NAME'] == $_COOKIE['bxmaker_geoip_2_4_2_city']){
                    $cityId = $ar_result['ID'];
                    break;
                }
            }
            ?>
            <?if($arResult['PROPERTIES']['DOCTORS_SPEC']['VALUE'] || $arResult['PROPERTIES']['CLINICS_SPEC']['VALUE']){?>
                <div class="illness-doctor-block">
                    <?if (strpos($doctorName, 'Болезнь') !== false && strpos($doctorName, 'Синдром') !== false ) {?>
                        <h6 class="title-h3 title-h3-top to-choice">К какому врачу обратиться при <?=mb_strtolower($doctorName)?>?</h6>
                    <?}else{?>
                        <?if(mb_substr($doctorName, -1) == 'а' || mb_substr($doctorName, -1) == 'а'){?>
                            <h6 class="title-h3 title-h3-top to-choice">К какому врачу обратиться при <?= mb_strtolower(mb_substr($doctorName,0,-1));?>е?</h6>
                        <?}
                    }?>
                    <p>С помощью нашего сервиса вы можете найти хорошего ортопеда или ортопедическую клинику, где можно пройти полное обследование по поводу искривления позвоночника. Если вам требуется операция, ознакомьтесь с отзывами и выберете хорошую ортопедическую больницу.</p>
                    <? if ($arResult['PROPERTIES']['DOCTORS_TEXT']["VALUE"]): ?>
                        <p><?= html_entity_decode($arResult['PROPERTIES']['DOCTORS_TEXT']['VALUE']['TEXT'])?></p>
                    <? endif; ?>
                    <?if($arResult['PROPERTIES']['DOCTORS_SPEC']['VALUE']):?>
                        <?global $arrFilter;
                        $arrFilter = Array(
                            "PROPERTY_SPECIALIZATIONS" => $arResult['PROPERTIES']['DOCTORS_SPEC']['VALUE'],
                            "PROPERTY_MAIN_SPECIALIZATION" => $arResult['PROPERTIES']['DOCTORS_SPEC']['VALUE'],
                            "PROPERTY_CITY" => $cityId,
                        );?>
                        <?$APPLICATION->IncludeComponent("bitrix:news.list","library_doctor",
                            Array(
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "Y",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => 10,
                                "PAGER_SHOW_ALL" => "Y",
                                "NEWS_COUNT" => "8",
                                "SORT_BY1" => "property_SECT_RATING",
                                "SORT_ORDER1" => "desc",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "FILTER_NAME" => 'arrFilter',
                                "FIELD_CODE" => array(
                                    0 => "DETAIL_TEXT",
                                    1 => "DETAIL_PICTURE",
                                    2 => "",
                                ),
                                "PROPERTY_CODE" => array(
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
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "Y",
                                "PAGER_TEMPLATE" => "show_more",
                                "PAGER_DESC_NUMBERING" => "Y",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "Y",
                                "SHOW_404" => "Y",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => ""
                            )
                        );?>
                    <?endif;?>
                    <?if($arResult['PROPERTIES']['CLINICS_SPEC']['VALUE']):?>
                        <h6 class="title-h3 title-h3-top to-choice">Клиники по профилю</h6>
                        <?$arrFilter = Array(
                            "PROPERTY_SPECIALIZATION" => $arResult['PROPERTIES']['CLINICS_SPEC']['VALUE'],
                            "PROPERTY_CITY" => $cityId,
                        );?>
                        <?$APPLICATION->IncludeComponent("bitrix:news.list","library_clinic",
                            Array(
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "Y",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => 9,
                                "PAGER_SHOW_ALL" => "Y",
                                "NEWS_COUNT" => "8",
                                "SORT_BY1" => "property_SECT_RATING",
                                "SORT_ORDER1" => "desc",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => 'arrFilter',
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "FIELD_CODE" => array(
                                    0 => "DETAIL_TEXT",
                                    1 => "DETAIL_PICTURE",
                                    2 => "",
                                ),
                                "PROPERTY_CODE" => array(
                                    0 => "SPECIALIZATION",
                                    1 => "ONLINE",
                                    2 => "ADDRESS",
                                    3 => "DOCTORS",
                                    4 => "WORK_TIME",
                                    5 => "DIAGNOSTICS",
                                    6 => "CONTACTS",
                                    7 => "MAP",
                                    8 => "AREA",
                                    9 => "COST_PRICE",
                                    10 => "REGION",
                                    11 => "METRO",
                                    12 => "DEPARTURE_HOUSE",
                                    13 => "CHILDREN_DOCTOR",
                                    14 => "DMC",
                                    15 => "UMC",
                                    16 => "CITY",
                                    17 => "",
                                ),
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "Y",
                                "PAGER_TEMPLATE" => "show_more",
                                "PAGER_DESC_NUMBERING" => "Y",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "Y",
                                "SHOW_404" => "Y",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => ""
                            )
                        );?>
                    <?endif;?>
                </div>
            <?}
            ?>
        </div>
    </div>
</section>