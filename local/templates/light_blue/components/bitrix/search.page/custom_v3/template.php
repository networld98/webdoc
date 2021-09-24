<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="search-page">
	<form action="" method="get">
		<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
	</form>
<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br />
<?endif;?>
    <?foreach ($arResult['SEARCH'] as $item){
        $cityId=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['CITY']['VALUE'];
        $areaId=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['AREA']['VALUE'];
        $metroIds=CIBlockElement::GetByID($item['ITEM_ID'])->GetNextElement()->GetProperties()['METRO']['VALUE'];
        foreach ($metroIds as $metro){
            $metroCodes[] = CIBlockElement::GetByID($metro)->GetNextElement()->GetFields()['CODE'];
        }
        if (is_array($cityId)){
            foreach ($cityId as $city){
                $cityCodes[] = CIBlockSection::GetByID($city)->GetNext()['CODE'];
            }
        }
        if (is_array($areaId)){
            foreach ($areaId as $area){
                $areaCodes[] = CIBlockSection::GetByID($area)->GetNext()['CODE'];
            }
        }
        if ($item['PARAM2'] == '9'){
            if($_GET['arrFilter_94'] == CIBlockSection::GetByID($cityId)->GetNext()['CODE'] ){
                $search[$item['PARAM2']][] = $item['ITEM_ID'];
            }
        }
        if ($item['PARAM2'] == '10'){
            if($_GET['arrFilter_94'] == CIBlockSection::GetByID($cityId[0])->GetNext()['CODE']){
                $search[$item['PARAM2']][] = $item['ITEM_ID'];
            }
        }
        if ($item['PARAM2'] == '18' || $item['PARAM2'] == '19' || $item['PARAM2'] == '20' || $item['PARAM2'] == '21' || $item['PARAM2'] == '22'){
            $search[$item['PARAM2']][] = $item['ITEM_ID'];
        }
    }
    ?>
    <? if (!empty($_GET['q']) && count($search) != 0){?>
        <div class="search-result"><?echo GetMessage("CT_BSP_FOUND")?>:
            <? if ($search[9]){?><a <?if (!empty($_GET['page']) && count($search[9])>0){?>href="<?=$APPLICATION->GetCurPageParam('',array('page'));?>"<?}?>><strong><?=count($search[9])?></strong> клиник(а)/врачей(а);</a><?}?>
            <? if ($search[10]){?><a <?if ($_GET['page'] != 'doctors' && count($search[10])>0){?>href="<?=$APPLICATION->GetCurPageParam('page=doctors',array('page'));?>"<?}?>><strong><?=count($search[10])?></strong> врач(а);</a><?}?>
            <? if ($search[18] || $search[19]){?><a <?if ($_GET['page'] != 'services' && (count($search[18])>0 || $search[19]>0)){?>href="<?=$APPLICATION->GetCurPageParam('page=services',array('page'));?>"<?}?>><strong><?=count($search[18])+count($search[19])?></strong> услуг(а);</a><?}?>
            <? if ($search[21]){?><a <?if ($_GET['page'] != 'illness' && count($search[21])>0){?>href="<?=$APPLICATION->GetCurPageParam('page=illness',array('page'));?>"<?}?>><strong><?=count($search[21])?></strong> болезнь(ей);</a><?}?>
            <? if ($search[22]){?><a <?if ($_GET['page'] != 'symptoms' && count($search[22])>0){?>href="<?=$APPLICATION->GetCurPageParam('page=symptoms',array('page'));?>"<?}?>><strong><?=count($search[22])?></strong> симптом(ов);</a><?}?>
            <? if ($search[20]){?><a <?if ($_GET['page'] != 'articles' && count($search[20])>0){?>href="<?=$APPLICATION->GetCurPageParam('page=articles',array('page'));?>"<?}?>><strong><?=count($search[20])?></strong> статья(и);</a><?}?>
        </div>
    <?}?>
	<div class="search-result">
		<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
        <?global $arrFilter;

              if (empty($_GET['page']) || $_GET['page'] == NULL){
                  $template = "search_clinic";
                  $iblockId = 9;
              }
              if ($_GET['page'] == 'doctors'){
                  $iblockId = 10;
                  if($arrFilter["=PROPERTY_94"] !=NULL){
                      $arrFilter["=PROPERTY_115"] = $arrFilter["=PROPERTY_94"];
                  }
                  if($arrFilter["=PROPERTY_93"] !=NULL){
                      $arrFilter["=PROPERTY_192"] = $arrFilter["=PROPERTY_93"];
                  }
                  if($arrFilter["=PROPERTY_92"] !=NULL){
                      $arrFilter["=PROPERTY_78"] = $arrFilter["=PROPERTY_92"];
                  }
                  if($arrFilter["=PROPERTY_97"] !=NULL){
                      $arrFilter["=PROPERTY_90"] = array(68);
                  }
                  if($arrFilter["=PROPERTY_83"] !=NULL){
                      $arrFilter["=PROPERTY_124"] = array(88);
                  }
                  if($arrFilter["=PROPERTY_86"] !=NULL){
                      $arrFilter["=PROPERTY_77"] = array(59);
                  }
                  if($arrFilter["=PROPERTY_84"] !=NULL){
                      $arrFilter["=PROPERTY_76"] = array(58);
                  }
                  if($arrFilter["=PROPERTY_85"] !=NULL){
                      $arrFilter["=PROPERTY_123"] = array(87);
                  }
                  if($arrFilter["=PROPERTY_89"] !=NULL){
                      $arrFilter["=PROPERTY_122"] = array(86);
                  }
                  $template = "search_doctor";
              }
                if ($_GET['page'] == 'services' || $_GET['page'] == 'articles' || $_GET['page'] == 'illness' || $_GET['page'] == 'symptoms') {
                    $template = "search_services";
                }
                if ($_GET['page'] == 'articles'){
                    $iblockId = 20;
                }
                if($_GET['page'] == 'illness'){
                    $iblockId = 21;
                }
                if($_GET['page'] == 'symptoms') {
                    $iblockId = 22;
                }
                if ($_GET['page'] == 'services'){
                    $iblockId = 19;
                }
              if ($_GET['page'] == 'services'){?>
                  <div class="container" id="blockService">
                      <h2>Услуги</h2>
                  </div>
              <?}elseif( $_GET['page'] == 'articles'){?>
                  <div class="container" id="blockArticles">
                      <h2>Статьи</h2>
                  </div>
              <?}elseif($_GET['page'] == 'illness'){?>
                  <div class="container" id="blockIllness">
                      <h2>Болезни</h2>
                  </div>
              <?}elseif($_GET['page'] == 'symptoms'){?>
                  <div class="container" id="blockSymptoms">
                      <h2>Симптомы</h2>
                  </div>
              <?}
        if (($_GET['q']== NULL && count($search)==0) || ($_GET['q'] != NULL && count($search)>0)){
            $arrFilter['=ID'] = $search[$iblockId];
            $APPLICATION->IncludeComponent("bitrix:news.list", "$template", Array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "Y",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => $iblockId,
                "NEWS_COUNT" => 5,
                "SORT_BY1" => "property_SECT_RATING",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arrFilter",
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
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "show_more",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "search_clinic",
                "STRICT_SECTION_CHECK" => "N",
                "FILE_404" => ""
            ),
                false
            );?>
            <?if ($_GET['page'] == 'services' && count($search[18])>0){?>
                <div class="container">
                    <h2>Диагностика</h2>
                </div>
                <?$arrFilter['=ID'] = $search[18];
                $APPLICATION->IncludeComponent("bitrix:news.list", "$template", Array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "Y",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => 19,
                    "NEWS_COUNT" => 5,
                    "SORT_BY1" => "property_SECT_RATING",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter",
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
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "show_more",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "Y",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "COMPONENT_TEMPLATE" => "search_clinic",
                    "STRICT_SECTION_CHECK" => "N",
                    "FILE_404" => ""
                ),
                    false
                );
            }
        }?>
        <?
        if($_GET['q']!= NULL && count($search) == 0){?>
            <?ShowNote(GetMessage("CT_BSP_NOTHING_TO_FOUND"));?>
        <?}?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('a[href^="#"]').on('click', function(event) {
                    event.preventDefault();
                    var sc = $(this).attr("href"),
                        dn = $(sc).offset().top;
                    $('html, body').animate({scrollTop: dn - 120}, 1000);
                });
            });
        </script>
        <div class="more_btn_block">
            <?if (!empty($_GET['page']) && count($search[9])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('',array('page')); ?>" class="show_search">
                    Показать Клиники
                </a>
            <?}?>
            <?if ($_GET['page'] != 'doctors' && count($search[10])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('page=doctors',array('page'))?>" class="show_search">
                    Показать Докторов
                </a>
            <?}?>
            <?if ($_GET['page'] != 'articles' && count($search[20])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('page=articles',array('page'))?>" class="show_search" >
                    Показать Статьи
                </a>
            <?}
            if($_GET['page'] != 'illness'  && count($search[21])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('page=illness',array('page'))?>" class="show_search">
                    Показать Болезни
                </a>
            <?}
            if($_GET['page'] != 'symptoms' && count($search[22])>0){?>
                <a href="<?=$APPLICATION->GetCurPageParam('page=symptoms',array('page'))?>" class="show_search" >
                    Показать Симптомы
                </a>
            <?}
            if ($_GET['page'] != 'services' && (count($search[18])>0 || count($search[19])>0)){?>
                <a href="<?=$APPLICATION->GetCurPageParam('page=services',array('page'));?>" class="show_search">
                    Показать Услуги
                </a>
            <?}?>
        </div>
	</div>
</div>